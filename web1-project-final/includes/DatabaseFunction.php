<?php
/**
 * Executes a prepared SQL query with type-aware parameter binding.
  */
function query($pdo, $sql, $parameters = []) {
    $query = $pdo->prepare($sql);

    // Bind parameters with their correct types to avoid issues with LIMIT, etc.
    foreach ($parameters as $key => $value) {
        if (is_int($value)) {
            $query->bindValue($key, $value, PDO::PARAM_INT);
        } else if (is_bool($value)) {
            $query->bindValue($key, $value, PDO::PARAM_BOOL);
        } else if (is_null($value)) {
            $query->bindValue($key, $value, PDO::PARAM_NULL);
        } else {
            $query->bindValue($key, $value, PDO::PARAM_STR);
        }
    }

    $query->execute();
    return $query;
}

/**
 * Fetches a single record from the database.
  */
function fetchOne($pdo, $sql, $parameters = []) {
    $query = query($pdo, $sql, $parameters);
    return $query->fetch(PDO::FETCH_ASSOC);
}

/**
 * Fetches all records from the database.
  */
function fetchAll($pdo, $sql, $parameters = []) {
    $query = query($pdo, $sql, $parameters);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Fetches a single column from the next row of a result set.
  */
function fetchColumn($pdo, $sql, $parameters = []) {
    $query = query($pdo, $sql, $parameters);
    return $query->fetchColumn();
}

/**
 * Gets the most recent posts from admin users.
  */
function getAdminQuestions($pdo, $limit = 3) {
    $sql = 'SELECT p.ID AS id, p.Title AS title, p.Content AS text, p.Image AS image, p.DateCreated AS date, u.Username AS username, u.ProfilePicture AS user_image, m.ModuleName AS module
            FROM Posts p
            JOIN Users u ON p.AuthorID = u.ID
            JOIN User_Roles ur ON u.ID = ur.UserID
            JOIN Roles r ON ur.RoleID = r.ID AND r.Name = \'Admin\' 
            LEFT JOIN Modules m ON p.ModuleID = m.ID
            ORDER BY p.ID DESC
            LIMIT :limit';
    return fetchAll($pdo, $sql, [':limit' => $limit]);
}

/**
 * Gets the most recent posts from all users.
  */
function getRecentQuestions($pdo, $limit = 25) {
    $sql = 'SELECT p.ID AS id, p.Title AS title, p.Content AS text, p.Image AS image, p.DateCreated AS date, u.Username AS username, m.ModuleName AS module
            FROM Posts p
            LEFT JOIN Users u ON p.AuthorID = u.ID
            LEFT JOIN Modules m ON p.ModuleID = m.ID
            ORDER BY p.ID DESC
            LIMIT :limit';
    return fetchAll($pdo, $sql, [':limit' => $limit]);
}

/**
 * Creates a notification for a user.
  */
function createNotification($pdo, $userId, $title, $type, $relatedEntityId) {
    $sql = "INSERT INTO notifications (userid, NotificationTitle, Type, RelatedEntityID, IsRead, DateCreated) 
            VALUES (:userid, :title, :type, :related_id, 0, NOW())";
    query($pdo, $sql, [
        ':userid' => $userId,
        ':title' => $title,
        ':type' => $type,
        ':related_id' => $relatedEntityId
    ]);
}

/**
 * Counts the number of unread notifications for a user.
  */
function countUnreadNotifications($pdo, $userId) {
    $sql = "SELECT COUNT(*) FROM notifications WHERE userid = :userid AND IsRead = 0 LIMIT 99";
    return fetchColumn($pdo, $sql, [':userid' => $userId]);
}

/**
 * Searches for posts based on various criteria.
  */
function searchPosts($pdo, $searchQuery, $moduleFilter, $userFilter, $limit, $offset) {
    $sql = 'SELECT p.ID AS id, p.Title AS title, p.Content AS text, p.Image AS image, p.DateCreated AS date, u.Username AS username, m.ModuleName AS module
            FROM posts p
            LEFT JOIN users u ON p.AuthorID = u.ID
            LEFT JOIN modules m ON p.ModuleID = m.ID
            WHERE 1=1';
    
    $params = [];
    if (!empty($searchQuery)) {
        $sql .= ' AND (p.Title LIKE :searchQuery OR p.Content LIKE :searchQuery OR m.ModuleName LIKE :searchQuery OR u.Username LIKE :searchQuery)';
        $params[':searchQuery'] = '%' . $searchQuery . '%';
    }
    if (!empty($moduleFilter)) {
        $sql .= ' AND m.ModuleName = :moduleFilter';
        $params[':moduleFilter'] = $moduleFilter;
    }
    if (!empty($userFilter)) {
        $sql .= ' AND u.Username = :userFilter';
        $params[':userFilter'] = $userFilter;
    }

    $sql .= ' ORDER BY p.ID DESC LIMIT :limit OFFSET :offset';
    $params[':limit'] = $limit;
    $params[':offset'] = $offset;

    return fetchAll($pdo, $sql, $params);
}

/**
 * Counts the total number of posts matching search criteria.
  */
function countSearchedPosts($pdo, $searchQuery, $moduleFilter, $userFilter) {
    $sql = 'SELECT COUNT(*) FROM posts p 
            LEFT JOIN modules m ON p.ModuleID = m.ID 
            LEFT JOIN users u ON p.AuthorID = u.ID 
            WHERE 1=1';
    $params = [];
    if (!empty($searchQuery)) {
        $sql .= ' AND (p.Title LIKE :searchQuery OR p.Content LIKE :searchQuery OR m.ModuleName LIKE :searchQuery OR u.Username LIKE :searchQuery)';
        $params[':searchQuery'] = '%' . $searchQuery . '%';
    }
    if (!empty($moduleFilter)) {
        $sql .= ' AND m.ModuleName = :moduleFilter';
        $params[':moduleFilter'] = $moduleFilter;
    }
    if (!empty($userFilter)) {
        $sql .= ' AND u.Username = :userFilter';
        $params[':userFilter'] = $userFilter;
    }
    return fetchColumn($pdo, $sql, $params);
}

/**
 * Gets all modules for filter dropdowns.
  */
function getAllModulesForFilter($pdo) {
    return fetchAll($pdo, 'SELECT ModuleName AS name FROM modules ORDER BY name ASC');
}

/**
 * Gets all users for filter dropdowns.
  */
function getAllUsersForFilter($pdo) {
    return fetchAll($pdo, 'SELECT Username AS name FROM users ORDER BY name ASC');
}

/**
 * Gets all badges for a specific user.
  */
function getUserBadges($pdo, $userId) {
    $sql = 'SELECT b.BadgeName, b.Description, ub.DateEarned, ub.UserID IS NOT NULL AS has_badge
            FROM Badges b
            LEFT JOIN User_Badges ub ON b.ID = ub.BadgeID AND ub.UserID = :user_id
            ORDER BY b.BadgeName ASC';
    return fetchAll($pdo, $sql, [':user_id' => $userId]);
}

/**
 * Gets all modules along with their post and answer counts.
  */
function getAllModulesWithStats($pdo) {
    $sql = 'SELECT 
                m.ID AS id, 
                m.ModuleName AS name, 
                m.Description AS description,
                (SELECT COUNT(*) FROM Posts p WHERE p.ModuleID = m.ID) AS questions_asked,
                (SELECT COUNT(*) FROM Answers a JOIN Posts p ON a.PostID = p.ID WHERE p.ModuleID = m.ID) AS questions_answered
            FROM modules m 
            ORDER BY m.ModuleName ASC';
    return fetchAll($pdo, $sql);
}

/**
 * Gets a paginated list of questions.
  */
function getPaginatedQuestions($pdo, $limit, $offset) {
    $sql = 'SELECT p.ID AS id, p.Title AS title, p.Content AS text, p.Image AS image, p.DateCreated AS date, u.Username AS username, m.ModuleName AS module
            FROM posts p
            LEFT JOIN users u ON p.AuthorID = u.ID
            LEFT JOIN modules m ON p.ModuleID = m.ID
            ORDER BY p.ID DESC
            LIMIT :limit OFFSET :offset';
    return fetchAll($pdo, $sql, [':limit' => $limit, ':offset' => $offset]);
}

/**
 * Counts the total number of posts.
  */
function countAllPosts($pdo) {
    return fetchColumn($pdo, "SELECT COUNT(*) FROM Posts");
}

/**
 * Gets a paginated list of users.
  */
function getPaginatedUsers($pdo, $limit, $offset) {
    $sql = 'SELECT u.ID AS id, u.Username AS username, u.Email AS email, u.ProfilePicture AS `image`,u.DateJoined AS date_joined
            FROM users u
            ORDER BY u.Username ASC
            LIMIT :limit OFFSET :offset';
    return fetchAll($pdo, $sql, [':limit' => $limit, ':offset' => $offset]);
}

/**
 * Counts the total number of users.
  */
function countAllUsers($pdo) {
    return fetchColumn($pdo, "SELECT COUNT(*) FROM users");
}

/**
 * Gets the details for a specific post.
  */
function getPostDetails($pdo, $postId) {
    $sql = 'SELECT p.Title, p.Content, p.Image, p.DateCreated, p.AuthorID, u.Username, m.ModuleName
            FROM Posts p
            LEFT JOIN Users u ON p.AuthorID = u.ID
            LEFT JOIN Modules m ON p.ModuleID = m.ID
            WHERE p.ID = :postID';
    return fetchOne($pdo, $sql, [':postID' => $postId]);
}

/**
 * Gets the vote count for a post.
  */
function getPostVoteCount($pdo, $postId, $voteType) {
    $sql = 'SELECT COUNT(*) FROM Votes v JOIN Vote_Type vt ON v.VoteTypeID = vt.ID WHERE v.PostID = :postID AND vt.VoteType = :voteType';
    return fetchColumn($pdo, $sql, [':postID' => $postId, ':voteType' => $voteType]);
}

/**
 * Gets the vote type cast by a user on a specific post.
  */
function getUserVoteForPost($pdo, $postId, $userId) {
    $sql = 'SELECT vt.VoteType FROM Votes v JOIN Vote_Type vt ON v.VoteTypeID = vt.ID WHERE v.PostID = :postID AND v.UserID = :userID';
    return fetchColumn($pdo, $sql, [':postID' => $postId, ':userID' => $userId]);
}

/**
 * Marks an answer as the accepted answer for a post.
  */
function acceptAnswer($pdo, $answerId, $postId) {
    // First, unset any previously accepted answer for this post
    query($pdo, 'UPDATE Answers SET AcceptedAnswerID = NULL WHERE PostID = :postID AND AcceptedAnswerID IS NOT NULL', [':postID' => $postId]);
    // Then, set the new accepted answer
    query($pdo, 'UPDATE Answers SET AcceptedAnswerID = ID WHERE ID = :answerID', [':answerID' => $answerId]);
}

/**
 * Unmarks an answer as the accepted answer.
  */
function unacceptAnswer($pdo, $answerId) {
    query($pdo, 'UPDATE Answers SET AcceptedAnswerID = NULL WHERE ID = :answerID', [':answerID' => $answerId]);
}

/**
 * Gets the ID for a given vote type string.
  */
function getVoteTypeId($pdo, $voteType) {
    return fetchColumn($pdo, 'SELECT ID FROM Vote_Type WHERE VoteType = :voteType', [':voteType' => $voteType]);
}

/**
 * Updates a user's vote on a post.
  */
function updateVote($pdo, $voteTypeId, $postId, $userId) {
    $sql = 'UPDATE Votes SET VoteTypeID = :voteTypeID WHERE PostID = :postID AND UserID = :userID';
    query($pdo, $sql, [':voteTypeID' => $voteTypeId, ':postID' => $postId, ':userID' => $userId]);
}

/**
 * Inserts a new vote for a user on a post.
  */
function insertVote($pdo, $voteTypeId, $postId, $userId) {
    $sql = 'INSERT INTO Votes (PostID, UserID, VoteTypeID) VALUES (:postID, :userID, :voteTypeID)';
    query($pdo, $sql, [':postID' => $postId, ':userID' => $userId, ':voteTypeID' => $voteTypeId]);
}

/**
 * Inserts a new answer to a post.
  */
function insertAnswer($pdo, $postId, $authorId, $content, $imagePath = null) {
    $sql = 'INSERT INTO Answers (PostID, AuthorID, Content, Image) VALUES (:postID, :authorID, :content, :image)';
    query($pdo, $sql, [':postID' => $postId, ':authorID' => $authorId, ':content' => $content, ':image' => $imagePath]);
}

/**
 * Fetches all answers for a given post.
  */
function getAnswersForPost($pdo, $postId) {
    $sql = 'SELECT a.ID, a.Content, a.Image, a.DateCreated, a.AuthorID, u.Username, a.AcceptedAnswerID
            FROM Answers a
            LEFT JOIN Users u ON a.AuthorID = u.ID
            WHERE a.PostID = :postID
            ORDER BY a.DateCreated ASC';
    return fetchAll($pdo, $sql, [':postID' => $postId]);
}

/**
 * Fetches the details of a specific user.
  */
function getUserDetails($pdo, $userId) {
    $sql = 'SELECT Username, Name, Email, ProfilePicture, DateJoined, About
            FROM Users
            WHERE ID = :userID';
    return fetchOne($pdo, $sql, [':userID' => $userId]);
}

/**
 * Fetches all posts created by a specific user.
  */
function getUserPosts($pdo, $userId) {
    $sql = 'SELECT ID, Title
            FROM Posts
            WHERE AuthorID = :userID
            ORDER BY DateCreated DESC';
    return fetchAll($pdo, $sql, [':userID' => $userId]);
}

/**
 * Fetches all answers submitted by a specific user.
  */
function getUserAnswers($pdo, $userId) {
    $sql = 'SELECT a.ID, a.Content, a.Image, p.ID as PostID, p.Title
            FROM Answers a
            JOIN Posts p ON a.PostID = p.ID
            WHERE a.AuthorID = :userID
            ORDER BY a.DateCreated DESC';
    return fetchAll($pdo, $sql, [':userID' => $userId]);
}

/**
 * Fetches all badges earned by a user.
  */
function getEarnedUserBadges($pdo, $userId) {
    $sql = 'SELECT b.BadgeName, b.Description
            FROM User_Badges ub
            JOIN Badges b ON ub.BadgeID  = b.ID
            WHERE ub.UserID = :userID';
    return fetchAll($pdo, $sql, [':userID' => $userId]);
}

/**
 * Fetches a user's public information for chat.
  */
function getChatRecipient($pdo, $userId) {
  $sql = "SELECT ID, Username, ProfilePicture FROM Users WHERE ID = :id";
  return fetchOne($pdo, $sql, ['id' => $userId]);
}

/**
* Inserts a new message into a conversation.
 */
function insertChatMessage($pdo, $senderId, $receiverId, $content) {
  $sql = "INSERT INTO Conversations (SenderID, ReceiverID, Content) VALUES (:sender, :receiver, :content)";
  query($pdo, $sql, [
      ':sender' => $senderId,
      ':receiver' => $receiverId,
      ':content' => $content
  ]);
}

/**
* Fetches the chat history between two users.
 */
function getChatHistory($pdo, $user1, $user2) {
  $sql = "SELECT c.ID, c.SenderID, c.ReceiverID, c.Content, c.SentAt, u.Username AS sender_name
          FROM Conversations c
          JOIN Users u ON c.SenderID = u.ID
          WHERE (c.SenderID = :user1 AND c.ReceiverID = :user2)
             OR (c.SenderID = :user2 AND c.ReceiverID = :user1)
          ORDER BY c.SentAt ASC";
  return fetchAll($pdo, $sql, [':user1' => $user1, ':user2' => $user2]);
}

/**
* Inserts a message for the admin.
 */
function insertAdminMessage($pdo, $content) {
  $sql = 'INSERT INTO adminmessage (Content) VALUES (:content)';
  query($pdo, $sql, [':content' => $content]);
}

/**
* Fetches answer details needed for deletion.
 */
function getAnswerDetailsForDeletion($pdo, $answerId) {
  $sql = 'SELECT Image, PostID, AuthorID FROM Answers WHERE ID = :id';
  return fetchOne($pdo, $sql, [':id' => $answerId]);
}

/**
* Deletes an answer from the database.
 */
function deleteAnswer($pdo, $answerId) {
  $sql = 'DELETE FROM Answers WHERE ID = :id';
  query($pdo, $sql, [':id' => $answerId]);
}

/**
* Deletes a chat message from the database.
 */
function deleteChatMessage($pdo, $messageId) {
  $sql = 'DELETE FROM Conversations WHERE ID = :id';
  query($pdo, $sql, [':id' => $messageId]);
}

/**
* Fetches the image name for a specific post.
 */
function getPostImage($pdo, $postId) {
  $sql = 'SELECT Image FROM Posts WHERE ID = :id';
  return fetchOne($pdo, $sql, [':id' => $postId]);
}

/**
* Deletes a post from the database.
 */
function deletePost($pdo, $postId) {
  $sql = 'DELETE FROM Posts WHERE ID = :id';
  query($pdo, $sql, [':id' => $postId]);
}

/**
* Fetches an answer for editing.
 */
function getAnswerForEdit($pdo, $answerId) {
  $sql = 'SELECT Content, Image, PostID, AuthorID FROM Answers WHERE ID = :id';
  return fetchOne($pdo, $sql, [':id' => $answerId]);
}

/**
* Updates an answer in the database.
 */
function updateAnswer($pdo, $answerId, $content, $imagePath) {
  $sql = 'UPDATE Answers SET Content = :content, Image = :image WHERE ID = :id';
  query($pdo, $sql, [
      ':content' => $content,
      ':image' => $imagePath,
      ':id' => $answerId
  ]);
}

/**
* Fetches a post for editing.
 */
function getPostForEdit($pdo, $postId) {
  $sql = 'SELECT ID, Title, Content, Image, AuthorID, ModuleID, DateCreated FROM Posts WHERE ID = :id';
  return fetchOne($pdo, $sql, [':id' => $postId]);
}

/**
* Fetches all modules.
 */
function getAllModules($pdo) {
  $sql = 'SELECT ID AS id, ModuleName AS name FROM Modules';
  return fetchAll($pdo, $sql);
}

/**
* Updates a post in the database.
 */
function updatePost($pdo, $postId, $title, $content, $imagePath, $moduleId) {
  $sql = 'UPDATE Posts SET Title = :title, Content = :content, Image = :image, ModuleID = :module_id WHERE ID = :id';
  query($pdo, $sql, [
      ':title' => $title,
      ':content' => $content,
      ':image' => $imagePath,
      ':module_id' => $moduleId,
      ':id' => $postId
  ]);
}

/**
* Fetches user information for the edit page.
 */
function getUserInfoForEdit($pdo, $userId) {
  $sql = 'SELECT Name, Email, About, ProfilePicture FROM Users WHERE ID = :id';
  return fetchOne($pdo, $sql, [':id' => $userId]);
}

/**
* Updates user information in the database.
 */
function updateUserInfo($pdo, $userId, $params) {
  $sql = 'UPDATE Users SET Name = :name, About = :about, ProfilePicture = :profile_picture';
  $updateParams = [
      ':name' => $params['name'] ?: null,
      ':about' => $params['about'] ?: null,
      ':profile_picture' => $params['imagePath'],
      ':id' => $userId
  ];

  if (!empty($params['password'])) {
      $sql .= ', Password = :password';
      $updateParams[':password'] = password_hash($params['password'], PASSWORD_DEFAULT);
  }

  $sql .= ' WHERE ID = :id';
  query($pdo, $sql, $updateParams);
}

/**
* Marks a notification as read.
 */
function markNotificationAsRead($pdo, $notificationId, $userId) {
  $sql = 'UPDATE Notifications SET IsRead = 1 WHERE ID = :id AND UserID = :user_id';
  query($pdo, $sql, [':id' => $notificationId, ':user_id' => $userId]);
}

/**
* Fetches notification details for redirection.
 */
function getNotificationDetails($pdo, $notificationId, $userId) {
  $sql = 'SELECT Type, RelatedEntityID FROM Notifications WHERE ID = :id AND UserID = :user_id';
  return fetchOne($pdo, $sql, [':id' => $notificationId, ':user_id' => $userId]);
}

/**
* Fetches all notifications for a user.
 */
function getAllUserNotifications($pdo, $userId) {
  $sql = 'SELECT n.ID AS id, n.NotificationTitle AS title, n.DateCreated AS date, n.IsRead AS is_read
          FROM Notifications n
          WHERE n.UserID = :user_id
          ORDER BY n.DateCreated DESC
          LIMIT 99';
  return fetchAll($pdo, $sql, [':user_id' => $userId]);
}
/**
 * Inserts a new post into the database.
  */
function insertPost($pdo, $title, $content, $authorId, $imagePath, $moduleId) {
    $sql = 'INSERT INTO Posts (Title, Content, Image, AuthorID, ModuleID)
            VALUES (:title, :content, :image, :author_id, :module_id)';
    query($pdo, $sql, [
        ':title' => $title,
        ':content' => $content,
        ':image' => $imagePath,
        ':author_id' => $authorId,
        ':module_id' => $moduleId
    ]);
}

/**
 * Checks if a username already exists in the database.
  */
function checkUsernameExists($pdo, $username) {
    $sql = 'SELECT ID FROM Users WHERE Username = :username';
    return fetchOne($pdo, $sql, ['username' => $username]) !== false;
}

/**
 * Checks if an email already exists in the database.
  */
function checkEmailExists($pdo, $email) {
    $sql = 'SELECT ID FROM Users WHERE Email = :email';
    return fetchOne($pdo, $sql, ['email' => $email]) !== false;
}

/**
 * Registers a new user by inserting them into the Users and User_Roles tables.
  */
function registerUser($pdo, $username, $hashed_password, $email) {
    // Insert into Users table
    $sqlUser = 'INSERT INTO Users (Username, Password, Email) VALUES (:username, :password, :email)';
    query($pdo, $sqlUser, [
        ':username' => $username,
        ':password' => $hashed_password,
        ':email' => $email
    ]);
    $userId = $pdo->lastInsertId();

    // Find RoleID for 'User'
    $sqlRole = 'SELECT ID FROM Roles WHERE Name = :name';
    $role = fetchOne($pdo, $sqlRole, [':name' => 'User']);
    
    if ($role) {
        $roleId = $role['ID'];
        // Insert into User_Roles table
        $sqlUserRole = 'INSERT INTO User_Roles (UserID, RoleID) VALUES (:user_id, :role_id)';
        query($pdo, $sqlUserRole, [
            ':user_id' => $userId,
            ':role_id' => $roleId
        ]);
    }
    
    return $userId;
}

/**
 * Fetches user details for login validation.
  */
function getUserByEmailForLogin($pdo, $email) {
    $sql = '
        SELECT u.ID AS id, 
               u.Username AS name,
               u.Password AS password,
               u.Email AS email,
               r.Name AS role
        FROM users u
        LEFT JOIN user_roles ur ON u.ID = ur.UserID
        LEFT JOIN roles r ON ur.RoleID = r.ID
        WHERE u.Email = :email
    ';
    return fetchOne($pdo, $sql, [':email' => $email]);
}
/**
 * Gets the total count of records in a given table.
  */
function getTableCount($pdo, $tableName) {
    // Basic whitelist to prevent SQL injection with table names
    $allowedTables = ['Badges', 'Users', 'Posts', 'Modules', 'Roles', 'adminmessage'];
    if (!in_array($tableName, $allowedTables)) {
        throw new InvalidArgumentException("Invalid table name provided.");
    }
    $sql = "SELECT COUNT(*) FROM `$tableName`";
    return fetchColumn($pdo, $sql);
}

/**
 * Searches a specific entity type based on a query.
*/
function searchAdminEntities($pdo, $entityType, $searchQuery, $limit, $offset) {
    $queries = [
        'modules' => 'SELECT ID AS id, ModuleName AS name, Description AS description FROM modules WHERE ModuleName LIKE :searchQuery OR Description LIKE :searchQuery',
        'badges' => 'SELECT ID AS id, BadgeName AS name, Description AS description FROM badges WHERE BadgeName LIKE :searchQuery OR Description LIKE :searchQuery',
        'users' => 'SELECT ID AS id, Username AS name, Email AS email, Name AS full_name FROM users WHERE Username LIKE :searchQuery OR Email LIKE :searchQuery OR Name LIKE :searchQuery',
        'questions' => 'SELECT p.ID AS id, p.Title AS title, p.Content AS content, u.Username AS author, m.ModuleName AS module FROM posts p LEFT JOIN users u ON p.AuthorID = u.ID LEFT JOIN modules m ON p.ModuleID = m.ID WHERE p.Title LIKE :searchQuery OR p.Content LIKE :searchQuery OR u.Username LIKE :searchQuery OR m.ModuleName LIKE :searchQuery'
    ];
    
    if (!array_key_exists($entityType, $queries)) {
        throw new InvalidArgumentException("Invalid entity type for search.");
    }

    $sql = $queries[$entityType] . ' ORDER BY id DESC LIMIT :limit OFFSET :offset';
    return fetchAll($pdo, $sql, [':searchQuery' => '%' . $searchQuery . '%', ':limit' => $limit, ':offset' => $offset]);
}

/**
 * Counts the total results for an admin entity search.
  */
function countAdminSearchedEntities($pdo, $entityType, $searchQuery) {
    $countQueries = [
        'modules' => 'SELECT COUNT(*) FROM modules WHERE ModuleName LIKE :searchQuery OR Description LIKE :searchQuery',
        'badges' => 'SELECT COUNT(*) FROM badges WHERE BadgeName LIKE :searchQuery OR Description LIKE :searchQuery',
        'users' => 'SELECT COUNT(*) FROM users WHERE Username LIKE :searchQuery OR Email LIKE :searchQuery OR Name LIKE :searchQuery',
        'questions' => 'SELECT COUNT(*) FROM posts p LEFT JOIN users u ON p.AuthorID = u.ID LEFT JOIN modules m ON p.ModuleID = m.ID WHERE p.Title LIKE :searchQuery OR p.Content LIKE :searchQuery OR u.Username LIKE :searchQuery OR m.ModuleName LIKE :searchQuery'
    ];

    if (!array_key_exists($entityType, $countQueries)) {
        throw new InvalidArgumentException("Invalid entity type for count.");
    }
    
    return fetchColumn($pdo, $countQueries[$entityType], [':searchQuery' => '%' . $searchQuery . '%']);
}

/**
 * Fetches all contact messages from the adminmessage table.
  */
function getAdminContactMessages($pdo) {
    $sql = "SELECT ID AS MessageID, Content, DateCreated AS Timestamp FROM adminmessage ORDER BY DateCreated DESC";
    return fetchAll($pdo, $sql);
}

/**
 * Fetches all roles from the database.
  */
function getAllRoles($pdo) {
    $sql = 'SELECT ID AS id, Name AS name FROM roles ORDER BY ID ASC';
    return fetchAll($pdo, $sql);
}

/**
 * Fetches user information, including their role ID, for editing in the admin panel.
  */
function getAdminUserInfoForEdit($pdo, $userId) {
    $sql = 'SELECT u.Name, u.About, u.ProfilePicture, ur.RoleID 
            FROM Users u 
            LEFT JOIN user_roles ur ON u.ID = ur.UserID 
            WHERE u.ID = :id';
    return fetchOne($pdo, $sql, [':id' => $userId]);
}

/**
 * Updates a user's information and role from the admin panel.
  */
function updateAdminUserInfoAndRole($pdo, $userId, $params) {
    // Update user info
    $sql = 'UPDATE Users SET Name = :name, About = :about, ProfilePicture = :profile_picture';
    $updateParams = [
        ':name' => $params['name'] ?: null,
        ':about' => $params['about'] ?: null,
        ':profile_picture' => $params['imagePath'],
        ':id' => $userId
    ];

    if (!empty($params['password'])) {
        $sql .= ', Password = :password';
        $updateParams[':password'] = password_hash($params['password'], PASSWORD_DEFAULT);
    }
    $sql .= ' WHERE ID = :id';
    query($pdo, $sql, $updateParams);

    // Update role
    if (isset($params['role_id'])) {
        // Delete existing role(s)
        query($pdo, "DELETE FROM user_roles WHERE UserID = :user_id", [':user_id' => $userId]);
        // Insert new role
        query($pdo, "INSERT INTO user_roles (UserID, RoleID) VALUES (:user_id, :role_id)", [':user_id' => $userId, ':role_id' => $params['role_id']]);
    }
}

/**
 * Checks if a user already has a specific badge.
  */
function userHasBadge($pdo, $userId, $badgeId) {
    $sql = 'SELECT COUNT(*) FROM user_badges WHERE UserID = :user_id AND BadgeID = :badge_id';
    return fetchColumn($pdo, $sql, [':user_id' => $userId, ':badge_id' => $badgeId]) > 0;
}

/**
 * Assigns a badge to a user.
  */
function giveUserBadge($pdo, $userId, $badgeId) {
    $sql = 'INSERT INTO user_badges (UserID, BadgeID) VALUES (:user_id, :badge_id)';
    query($pdo, $sql, [':user_id' => $userId, ':badge_id' => $badgeId]);
}

/**
 * Fetches all users for a dropdown list.
  */
function getAllUsersForDropdown($pdo) {
    $sql = 'SELECT ID, Username FROM users ORDER BY Username ASC';
    return fetchAll($pdo, $sql);
}

/**
 * Fetches all badges for a dropdown list.
  */
function getAllBadgesForDropdown($pdo) {
    $sql = 'SELECT ID, BadgeName FROM badges ORDER BY BadgeName ASC';
    return fetchAll($pdo, $sql);
}
/**
 * Adds a new module to the database.
  */
function addModule($pdo, $name, $description) {
    $sql = 'INSERT INTO modules (ModuleName, Description) VALUES (:name, :description)';
    query($pdo, $sql, [':name' => $name, ':description' => $description]);
}

/**
 * Deletes a badge from the database.
  */
function deleteBadge($pdo, $badgeId) {
    $sql = "DELETE FROM badges WHERE ID = :id";
    query($pdo, $sql, [':id' => $badgeId]);
}

/**
 * Deletes a contact message from the database.
  */
function deleteAdminMessage($pdo, $messageId) {
    $sql = "DELETE FROM adminmessage WHERE ID = :id";
    query($pdo, $sql, [':id' => $messageId]);
}

/**
 * Deletes a module from the database.
  */
function deleteModule($pdo, $moduleId) {
    // Note: You may want to handle posts associated with this module first.
    // For example, setting their ModuleID to NULL.
    $sql = "DELETE FROM modules WHERE ID = :id";
    query($pdo, $sql, [':id' => $moduleId]);
}

/**
 * Deletes a user and their associated content from the database.
  */
function deleteUserAndContent($pdo, $userId) {
    // This is a more complex operation and should be handled with care,
    // potentially within a transaction.

    // 1. Get user's profile picture to delete file
    $user = fetchOne($pdo, "SELECT ProfilePicture FROM users WHERE ID = :id", [':id' => $userId]);
    if ($user && !empty($user['ProfilePicture'])) {
        $imagePath = '../upload/uploads/' . $user['ProfilePicture'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // 2. Get all post images by the user to delete files
    $posts = fetchAll($pdo, "SELECT Image FROM posts WHERE AuthorID = :id", [':id' => $userId]);
    foreach ($posts as $post) {
        if (!empty($post['Image'])) {
            $imagePath = '../upload/uploads/' . $post['Image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    }
    
    // 3. Delete the user record. Associated records in user_roles, posts, answers, etc.,
    // should be handled by ON DELETE CASCADE constraints in the database schema for robustness.
    // If not using cascades, you would need to delete from each table manually.
    query($pdo, "DELETE FROM users WHERE ID = :id", [':id' => $userId]);
}


/**
 * Fetches a single badge for editing.
  */
function getBadgeForEdit($pdo, $badgeId) {
    $sql = "SELECT BadgeName, Description FROM badges WHERE ID = :id";
    return fetchOne($pdo, $sql, [':id' => $badgeId]);
}

/**
 * Updates a badge in the database.
  */
function updateBadge($pdo, $badgeId, $name, $description) {
    $sql = 'UPDATE badges SET BadgeName = :name, Description = :description WHERE ID = :id';
    query($pdo, $sql, [':name' => $name, ':description' => $description, ':id' => $badgeId]);
}

/**
 * Fetches a single module for editing.
  */
function getModuleForEdit($pdo, $moduleId) {
    $sql = "SELECT ModuleName, Description FROM modules WHERE ID = :id";
    return fetchOne($pdo, $sql, [':id' => $moduleId]);
}

/**
 * Updates a module in the database.
  */
function updateModule($pdo, $moduleId, $name, $description) {
    $sql = 'UPDATE modules SET ModuleName = :name, Description = :description WHERE ID = :id';
    query($pdo, $sql, [':name' => $name, ':description' => $description, ':id' => $moduleId]);
}
/**
 * Adds a new badge to the database.
  */
function addBadge($pdo, $name, $description) {
    $sql = 'INSERT INTO badges (BadgeName, Description) VALUES (:name, :description)';
    query($pdo, $sql, [':name' => $name, ':description' => $description]);
}
