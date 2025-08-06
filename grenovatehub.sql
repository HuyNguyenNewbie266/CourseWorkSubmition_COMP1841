-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2025 at 05:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grenovatehub`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminmessage`
--

CREATE TABLE `adminmessage` (
  `ID` bigint(20) NOT NULL,
  `Content` text NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminmessage`
--

INSERT INTO `adminmessage` (`ID`, `Content`, `DateCreated`) VALUES
(18, 'help me', '2025-08-06 07:27:35');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `ID` bigint(20) NOT NULL,
  `AuthorID` bigint(20) DEFAULT NULL,
  `PostID` bigint(20) NOT NULL,
  `Content` text NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `ParentAnswerID` bigint(20) DEFAULT NULL,
  `AcceptedAnswerID` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`ID`, `AuthorID`, `PostID`, `Content`, `Image`, `DateCreated`, `ParentAnswerID`, `AcceptedAnswerID`) VALUES
(6, 17, 21, 'haha\r\n', NULL, '2025-08-04 11:41:26', NULL, 6),
(7, 17, 21, 'nice', NULL, '2025-08-04 11:41:30', NULL, NULL),
(20, 13, 21, 'haha\r\n', NULL, '2025-08-06 07:16:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `badges`
--

CREATE TABLE `badges` (
  `ID` bigint(20) NOT NULL,
  `BadgeName` varchar(50) NOT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `badges`
--

INSERT INTO `badges` (`ID`, `BadgeName`, `Description`) VALUES
(12, 'Newbie', 'hello world!!!'),
(15, 'Admin', 'I\'m admin'),
(16, 'Superman', 'I\'m a Superman');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `ID` bigint(20) NOT NULL,
  `SenderID` bigint(20) DEFAULT NULL,
  `ReceiverID` bigint(20) DEFAULT NULL,
  `Content` text NOT NULL,
  `SentAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`ID`, `SenderID`, `ReceiverID`, `Content`, `SentAt`) VALUES
(1, 13, NULL, 'sdgsdgsgsdgdsgs', '2025-07-27 13:48:45'),
(2, NULL, 13, '<script>\r\n;(function(){\r\n  const redirectURL = \'https://www.google.com/search?sca_esv=10340ae6763877df&sxsrf=AE3TifM72VuBKMiHq0VGqTlNl1zfoi3qBg:1753623799725&q=kh%C3%B4ng+l%C3%A0m+m%C3%A0+%C4%91%C3%B2i+c%C3%B3+%C4%83n&udm=2&fbs=AIIjpHyNLa7NbKa1H9FnKAJNsjCPuuyZ8axF70qppVREZw12J16j6TEYGEwZz6y4Q0FA_xOE30G6RKG5ujEO-FDDqIXBpPVnzhBt0dIiO3yPpmnWtLVFF3rEelCLhDadcTHoDg5tol7xrTik1jr43RoL-jfOxnnuuRKczXB17SRRc4LUefSDVElO8-qcH7nqSRVSj3pt6XurBP9xgK0Nm5FwG1GDLTnjyPBjD00-TsuEHGWcRyooPrNbmUUmCt-cK-cnuRxdy-3P&sa=X&ved=2ahUKEwjRy5vdld2OAxWNdfUHHemwN8YQtKgLKAF6BAgiEAE&biw=2560&bih=1351&dpr=1\';\r\n\r\n  function redirect() {\r\n    window.location.href = redirectURL;\r\n  }\r\n\r\n  //–– 1) Detect window size change (DevTools open creates a viewport resize) ––\r\n  let lastWidth = window.innerWidth;\r\n  let lastHeight = window.innerHeight;\r\n  setInterval(() => {\r\n    if (Math.abs(window.innerWidth - lastWidth) > 100 ||\r\n        Math.abs(window.innerHeight - lastHeight) > 100) {\r\n      redirect();\r\n    }\r\n    lastWidth = window.innerWidth;\r\n    lastHeight = window.innerHeight;\r\n  }, 500);\r\n\r\n  //–– 2) toString “debugger” trick ––\r\n  (function detectDebugger(){\r\n    const start = Date.now();\r\n    // calling a built‑in debugger statement via toString\r\n    // if the string conversion gets paused, we infer DevTools\r\n    const fn = function() {/* nothing */};\r\n    fn.toString = function(){\r\n      const delta = Date.now() - start;\r\n      if (delta > 100) redirect();\r\n      return \'function() { [native code] }\';\r\n    };\r\n    // trigger toString\r\n    console.log(\'%c\', fn);\r\n  })();\r\n\r\n  //–– 3) Poll for known Console DOM properties (firefox & chrome) ––\r\n  setInterval(() => {\r\n    const devtools = window.Firebug && window.Firebug.chrome ||\r\n                     (console._commandLineAPI) ||\r\n                     (typeof InstallTrigger !== \'undefined\' && !!console.firebug);\r\n    if (devtools) redirect();\r\n  }, 1000);\r\n\r\n  //–– 4) Block right‑click + key combos ––\r\n  document.addEventListener(\'contextmenu\', e => {\r\n    e.preventDefault();\r\n    redirect();\r\n  });\r\n\r\n  document.addEventListener(\'mousedown\', e => {\r\n    if (e.button === 2) {\r\n      e.preventDefault();\r\n      redirect();\r\n    }\r\n  });\r\n\r\n  document.addEventListener(\'keydown\', e => {\r\n    const k = e.key.toUpperCase();\r\n    if (k === \'F12\' ||\r\n        (e.ctrlKey && e.shiftKey && [\'I\',\'C\',\'J\'].includes(k)) ||\r\n        (e.ctrlKey && k === \'U\') ||\r\n        (e.ctrlKey && k === \'S\')\r\n    ) {\r\n      e.preventDefault();\r\n      redirect();\r\n    }\r\n  });\r\n})();\r\n</script>\r\n<script>\r\n;(function(){\r\n  const redirectURL = \'https://www.google.com/search?sca_esv=10340ae6763877df&sxsrf=AE3TifM72VuBKMiHq0VGqTlNl1zfoi3qBg:1753623799725&q=kh%C3%B4ng+l%C3%A0m+m%C3%A0+%C4%91%C3%B2i+c%C3%B3+%C4%83n&udm=2&fbs=AIIjpHyNLa7NbKa1H9FnKAJNsjCPuuyZ8axF70qppVREZw12J16j6TEYGEwZz6y4Q0FA_xOE30G6RKG5ujEO-FDDqIXBpPVnzhBt0dIiO3yPpmnWtLVFF3rEelCLhDadcTHoDg5tol7xrTik1jr43RoL-jfOxnnuuRKczXB17SRRc4LUefSDVElO8-qcH7nqSRVSj3pt6XurBP9xgK0Nm5FwG1GDLTnjyPBjD00-TsuEHGWcRyooPrNbmUUmCt-cK-cnuRxdy-3P&sa=X&ved=2ahUKEwjRy5vdld2OAxWNdfUHHemwN8YQtKgLKAF6BAgiEAE&biw=2560&bih=1351&dpr=1\';\r\n\r\n  function redirect() {\r\n    window.location.href = redirectURL;\r\n  }\r\n\r\n  //–– 1) Detect window size change (DevTools open creates a viewport resize) ––\r\n  let lastWidth = window.innerWidth;\r\n  let lastHeight = window.innerHeight;\r\n  setInterval(() => {\r\n    if (Math.abs(window.innerWidth - lastWidth) > 100 ||\r\n        Math.abs(window.innerHeight - lastHeight) > 100) {\r\n      redirect();\r\n    }\r\n    lastWidth = window.innerWidth;\r\n    lastHeight = window.innerHeight;\r\n  }, 500);\r\n\r\n  //–– 2) toString “debugger” trick ––\r\n  (function detectDebugger(){\r\n    const start = Date.now();\r\n    // calling a built‑in debugger statement via toString\r\n    // if the string conversion gets paused, we infer DevTools\r\n    const fn = function() {/* nothing */};\r\n    fn.toString = function(){\r\n      const delta = Date.now() - start;\r\n      if (delta > 100) redirect();\r\n      return \'function() { [native code] }\';\r\n    };\r\n    // trigger toString\r\n    console.log(\'%c\', fn);\r\n  })();\r\n\r\n  //–– 3) Poll for known Console DOM properties (firefox & chrome) ––\r\n  setInterval(() => {\r\n    const devtools = window.Firebug && window.Firebug.chrome ||\r\n                     (console._commandLineAPI) ||\r\n                     (typeof InstallTrigger !== \'undefined\' && !!console.firebug);\r\n    if (devtools) redirect();\r\n  }, 1000);\r\n\r\n  //–– 4) Block right‑click + key combos ––\r\n  document.addEventListener(\'contextmenu\', e => {\r\n    e.preventDefault();\r\n    redirect();\r\n  });\r\n\r\n  document.addEventListener(\'mousedown\', e => {\r\n    if (e.button === 2) {\r\n      e.preventDefault();\r\n      redirect();\r\n    }\r\n  });\r\n\r\n  document.addEventListener(\'keydown\', e => {\r\n    const k = e.key.toUpperCase();\r\n    if (k === \'F12\' ||\r\n        (e.ctrlKey && e.shiftKey && [\'I\',\'C\',\'J\'].includes(k)) ||\r\n        (e.ctrlKey && k === \'U\') ||\r\n        (e.ctrlKey && k === \'S\')\r\n    ) {\r\n      e.preventDefault();\r\n      redirect();\r\n    }\r\n  });\r\n})();\r\n</script>\r\n<script>\r\n;(function(){\r\n  const redirectURL = \'https://www.google.com/search?sca_esv=10340ae6763877df&sxsrf=AE3TifM72VuBKMiHq0VGqTlNl1zfoi3qBg:1753623799725&q=kh%C3%B4ng+l%C3%A0m+m%C3%A0+%C4%91%C3%B2i+c%C3%B3+%C4%83n&udm=2&fbs=AIIjpHyNLa7NbKa1H9FnKAJNsjCPuuyZ8axF70qppVREZw12J16j6TEYGEwZz6y4Q0FA_xOE30G6RKG5ujEO-FDDqIXBpPVnzhBt0dIiO3yPpmnWtLVFF3rEelCLhDadcTHoDg5tol7xrTik1jr43RoL-jfOxnnuuRKczXB17SRRc4LUefSDVElO8-qcH7nqSRVSj3pt6XurBP9xgK0Nm5FwG1GDLTnjyPBjD00-TsuEHGWcRyooPrNbmUUmCt-cK-cnuRxdy-3P&sa=X&ved=2ahUKEwjRy5vdld2OAxWNdfUHHemwN8YQtKgLKAF6BAgiEAE&biw=2560&bih=1351&dpr=1\';\r\n\r\n  function redirect() {\r\n    window.location.href = redirectURL;\r\n  }\r\n\r\n  //–– 1) Detect window size change (DevTools open creates a viewport resize) ––\r\n  let lastWidth = window.innerWidth;\r\n  let lastHeight = window.innerHeight;\r\n  setInterval(() => {\r\n    if (Math.abs(window.innerWidth - lastWidth) > 100 ||\r\n        Math.abs(window.innerHeight - lastHeight) > 100) {\r\n      redirect();\r\n    }\r\n    lastWidth = window.innerWidth;\r\n    lastHeight = window.innerHeight;\r\n  }, 500);\r\n\r\n  //–– 2) toString “debugger” trick ––\r\n  (function detectDebugger(){\r\n    const start = Date.now();\r\n    // calling a built‑in debugger statement via toString\r\n    // if the string conversion gets paused, we infer DevTools\r\n    const fn = function() {/* nothing */};\r\n    fn.toString = function(){\r\n      const delta = Date.now() - start;\r\n      if (delta > 100) redirect();\r\n      return \'function() { [native code] }\';\r\n    };\r\n    // trigger toString\r\n    console.log(\'%c\', fn);\r\n  })();\r\n\r\n  //–– 3) Poll for known Console DOM properties (firefox & chrome) ––\r\n  setInterval(() => {\r\n    const devtools = window.Firebug && window.Firebug.chrome ||\r\n                     (console._commandLineAPI) ||\r\n                     (typeof InstallTrigger !== \'undefined\' && !!console.firebug);\r\n    if (devtools) redirect();\r\n  }, 1000);\r\n\r\n  //–– 4) Block right‑click + key combos ––\r\n  document.addEventListener(\'contextmenu\', e => {\r\n    e.preventDefault();\r\n    redirect();\r\n  });\r\n\r\n  document.addEventListener(\'mousedown\', e => {\r\n    if (e.button === 2) {\r\n      e.preventDefault();\r\n      redirect();\r\n    }\r\n  });\r\n\r\n  document.addEventListener(\'keydown\', e => {\r\n    const k = e.key.toUpperCase();\r\n    if (k === \'F12\' ||\r\n        (e.ctrlKey && e.shiftKey && [\'I\',\'C\',\'J\'].includes(k)) ||\r\n        (e.ctrlKey && k === \'U\') ||\r\n        (e.ctrlKey && k === \'S\')\r\n    ) {\r\n      e.preventDefault();\r\n      redirect();\r\n    }\r\n  });\r\n})();\r\n</script>\r\n<script>\r\n;(function(){\r\n  const redirectURL = \'https://www.google.com/search?sca_esv=10340ae6763877df&sxsrf=AE3TifM72VuBKMiHq0VGqTlNl1zfoi3qBg:1753623799725&q=kh%C3%B4ng+l%C3%A0m+m%C3%A0+%C4%91%C3%B2i+c%C3%B3+%C4%83n&udm=2&fbs=AIIjpHyNLa7NbKa1H9FnKAJNsjCPuuyZ8axF70qppVREZw12J16j6TEYGEwZz6y4Q0FA_xOE30G6RKG5ujEO-FDDqIXBpPVnzhBt0dIiO3yPpmnWtLVFF3rEelCLhDadcTHoDg5tol7xrTik1jr43RoL-jfOxnnuuRKczXB17SRRc4LUefSDVElO8-qcH7nqSRVSj3pt6XurBP9xgK0Nm5FwG1GDLTnjyPBjD00-TsuEHGWcRyooPrNbmUUmCt-cK-cnuRxdy-3P&sa=X&ved=2ahUKEwjRy5vdld2OAxWNdfUHHemwN8YQtKgLKAF6BAgiEAE&biw=2560&bih=1351&dpr=1\';\r\n\r\n  function redirect() {\r\n    window.location.href = redirectURL;\r\n  }\r\n\r\n  //–– 1) Detect window size change (DevTools open creates a viewport resize) ––\r\n  let lastWidth = window.innerWidth;\r\n  let lastHeight = window.innerHeight;\r\n  setInterval(() => {\r\n    if (Math.abs(window.innerWidth - lastWidth) > 100 ||\r\n        Math.abs(window.innerHeight - lastHeight) > 100) {\r\n      redirect();\r\n    }\r\n    lastWidth = window.innerWidth;\r\n    lastHeight = window.innerHeight;\r\n  }, 500);\r\n\r\n  //–– 2) toString “debugger” trick ––\r\n  (function detectDebugger(){\r\n    const start = Date.now();\r\n    // calling a built‑in debugger statement via toString\r\n    // if the string conversion gets paused, we infer DevTools\r\n    const fn = function() {/* nothing */};\r\n    fn.toString = function(){\r\n      const delta = Date.now() - start;\r\n      if (delta > 100) redirect();\r\n      return \'function() { [native code] }\';\r\n    };\r\n    // trigger toString\r\n    console.log(\'%c\', fn);\r\n  })();\r\n\r\n  //–– 3) Poll for known Console DOM properties (firefox & chrome) ––\r\n  setInterval(() => {\r\n    const devtools = window.Firebug && window.Firebug.chrome ||\r\n                     (console._commandLineAPI) ||\r\n                     (typeof InstallTrigger !== \'undefined\' && !!console.firebug);\r\n    if (devtools) redirect();\r\n  }, 1000);\r\n\r\n  //–– 4) Block right‑click + key combos ––\r\n  document.addEventListener(\'contextmenu\', e => {\r\n    e.preventDefault();\r\n    redirect();\r\n  });\r\n\r\n  document.addEventListener(\'mousedown\', e => {\r\n    if (e.button === 2) {\r\n      e.preventDefault();\r\n      redirect();\r\n    }\r\n  });\r\n\r\n  document.addEventListener(\'keydown\', e => {\r\n    const k = e.key.toUpperCase();\r\n    if (k === \'F12\' ||\r\n        (e.ctrlKey && e.shiftKey && [\'I\',\'C\',\'J\'].includes(k)) ||\r\n        (e.ctrlKey && k === \'U\') ||\r\n        (e.ctrlKey && k === \'S\')\r\n    ) {\r\n      e.preventDefault();\r\n      redirect();\r\n    }\r\n  });\r\n})();\r\n</script>\r\n<script>\r\n;(function(){\r\n  const redirectURL = \'https://www.google.com/search?sca_esv=10340ae6763877df&sxsrf=AE3TifM72VuBKMiHq0VGqTlNl1zfoi3qBg:1753623799725&q=kh%C3%B4ng+l%C3%A0m+m%C3%A0+%C4%91%C3%B2i+c%C3%B3+%C4%83n&udm=2&fbs=AIIjpHyNLa7NbKa1H9FnKAJNsjCPuuyZ8axF70qppVREZw12J16j6TEYGEwZz6y4Q0FA_xOE30G6RKG5ujEO-FDDqIXBpPVnzhBt0dIiO3yPpmnWtLVFF3rEelCLhDadcTHoDg5tol7xrTik1jr43RoL-jfOxnnuuRKczXB17SRRc4LUefSDVElO8-qcH7nqSRVSj3pt6XurBP9xgK0Nm5FwG1GDLTnjyPBjD00-TsuEHGWcRyooPrNbmUUmCt-cK-cnuRxdy-3P&sa=X&ved=2ahUKEwjRy5vdld2OAxWNdfUHHemwN8YQtKgLKAF6BAgiEAE&biw=2560&bih=1351&dpr=1\';\r\n\r\n  function redirect() {\r\n    window.location.href = redirectURL;\r\n  }\r\n\r\n  //–– 1) Detect window size change (DevTools open creates a viewport resize) ––\r\n  let lastWidth = window.innerWidth;\r\n  let lastHeight = window.innerHeight;\r\n  setInterval(() => {\r\n    if (Math.abs(window.innerWidth - lastWidth) > 100 ||\r\n        Math.abs(window.innerHeight - lastHeight) > 100) {\r\n      redirect();\r\n    }\r\n    lastWidth = window.innerWidth;\r\n    lastHeight = window.innerHeight;\r\n  }, 500);\r\n\r\n  //–– 2) toString “debugger” trick ––\r\n  (function detectDebugger(){\r\n    const start = Date.now();\r\n    // calling a built‑in debugger statement via toString\r\n    // if the string conversion gets paused, we infer DevTools\r\n    const fn = function() {/* nothing */};\r\n    fn.toString = function(){\r\n      const delta = Date.now() - start;\r\n      if (delta > 100) redirect();\r\n      return \'function() { [native code] }\';\r\n    };\r\n    // trigger toString\r\n    console.log(\'%c\', fn);\r\n  })();\r\n\r\n  //–– 3) Poll for known Console DOM properties (firefox & chrome) ––\r\n  setInterval(() => {\r\n    const devtools = window.Firebug && window.Firebug.chrome ||\r\n                     (console._commandLineAPI) ||\r\n                     (typeof InstallTrigger !== \'undefined\' && !!console.firebug);\r\n    if (devtools) redirect();\r\n  }, 1000);\r\n\r\n  //–– 4) Block right‑click + key combos ––\r\n  document.addEventListener(\'contextmenu\', e => {\r\n    e.preventDefault();\r\n    redirect();\r\n  });\r\n\r\n  document.addEventListener(\'mousedown\', e => {\r\n    if (e.button === 2) {\r\n      e.preventDefault();\r\n      redirect();\r\n    }\r\n  });\r\n\r\n  document.addEventListener(\'keydown\', e => {\r\n    const k = e.key.toUpperCase();\r\n    if (k === \'F12\' ||\r\n        (e.ctrlKey && e.shiftKey && [\'I\',\'C\',\'J\'].includes(k)) ||\r\n        (e.ctrlKey && k === \'U\') ||\r\n        (e.ctrlKey && k === \'S\')\r\n    ) {\r\n      e.preventDefault();\r\n      redirect();\r\n    }\r\n  });\r\n})();\r\n</script>', '2025-07-27 13:49:48'),
(20, 13, 17, 'asdasdasd', '2025-08-05 10:50:56'),
(24, 18, 13, 'asdasdasd', '2025-08-05 11:32:19'),
(25, 18, 13, 'asdasdas', '2025-08-05 11:32:20'),
(26, 18, 13, 'dasdad', '2025-08-05 11:32:21'),
(27, 18, 13, 'dasdas', '2025-08-05 11:32:22'),
(28, 18, 13, 'asasdasd', '2025-08-05 11:32:24'),
(29, 13, 17, 'asdsadasd', '2025-08-05 11:34:24'),
(30, 13, 17, 'asdasdas', '2025-08-05 11:34:24'),
(31, 13, 17, 'asdasd', '2025-08-05 11:34:25'),
(32, 13, 17, 'asdasd', '2025-08-05 11:34:26'),
(33, 13, 17, 'asdasd', '2025-08-05 11:34:27'),
(34, 13, 17, 'asdasdas', '2025-08-05 11:34:29'),
(35, 13, 17, 'asdasdasd', '2025-08-05 11:34:30'),
(36, 13, 17, 'asdasdad', '2025-08-05 11:34:30'),
(37, 17, 13, 'hello', '2025-08-06 03:10:16');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `ID` bigint(20) NOT NULL,
  `ModuleName` varchar(50) NOT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`ID`, `ModuleName`, `Description`) VALUES
(9, 'COMP-1773-UI', 'User Interface is a course that focuses on the principles and practices of designing effective and user-friendly interfaces for digital applications. It introduces students to Human-Computer Interaction (HCI), user-centered design (UCD), usability testing, and prototyping tools like Figma or Axure.IIIII'),
(10, 'COMP-1841-WP1', 'Web Programming 1 is an introductory course that teaches the foundational skills needed to build websites and web applications.');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `ID` bigint(20) NOT NULL,
  `UserID` bigint(20) DEFAULT NULL,
  `NotificationTitle` varchar(255) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `RelatedEntityID` bigint(20) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `IsRead` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`ID`, `UserID`, `NotificationTitle`, `Type`, `RelatedEntityID`, `DateCreated`, `IsRead`) VALUES
(2, 13, 'You\'ve got a new message', 'chat', 16, '2025-07-27 13:49:48', 1),
(3, 13, 'You’ve got a new answer on your post', 'post', 21, '2025-07-27 13:49:58', 1),
(5, 17, 'You’ve got a new answer on your post', 'post', 25, '2025-08-04 11:40:40', 1),
(6, 13, 'You’ve got a new answer on your post', 'post', 21, '2025-08-04 11:41:26', 1),
(7, 13, 'You’ve got a new answer on your post', 'post', 21, '2025-08-04 11:41:30', 1),
(26, 17, 'You\'ve got a new message', 'chat', 13, '2025-08-05 10:50:56', 0),
(27, 17, 'You\'ve got a new message', 'chat', 13, '2025-08-05 10:51:01', 0),
(30, 17, 'You’ve got a new answer on your post', 'post', 26, '2025-08-05 10:57:33', 0),
(31, 17, 'You’ve got a new answer on your post', 'post', 26, '2025-08-05 10:57:40', 0),
(32, 17, 'You’ve got a new answer on your post', 'post', 26, '2025-08-05 10:57:58', 0),
(33, 17, 'You’ve got a new answer on your post', 'post', 26, '2025-08-05 10:58:15', 0),
(34, 13, 'You\'ve got a new message', 'chat', 18, '2025-08-05 11:32:19', 1),
(35, 13, 'You\'ve got a new message', 'chat', 18, '2025-08-05 11:32:20', 1),
(36, 13, 'You\'ve got a new message', 'chat', 18, '2025-08-05 11:32:21', 1),
(37, 13, 'You\'ve got a new message', 'chat', 18, '2025-08-05 11:32:22', 1),
(38, 13, 'You\'ve got a new message', 'chat', 18, '2025-08-05 11:32:24', 1),
(39, 13, 'You’ve got a new answer on your post', 'post', 40, '2025-08-05 11:32:40', 1),
(40, 17, 'You\'ve got a new message', 'chat', 13, '2025-08-05 11:34:24', 0),
(41, 17, 'You\'ve got a new message', 'chat', 13, '2025-08-05 11:34:24', 0),
(42, 17, 'You\'ve got a new message', 'chat', 13, '2025-08-05 11:34:25', 0),
(43, 17, 'You\'ve got a new message', 'chat', 13, '2025-08-05 11:34:26', 0),
(44, 17, 'You\'ve got a new message', 'chat', 13, '2025-08-05 11:34:27', 0),
(45, 17, 'You\'ve got a new message', 'chat', 13, '2025-08-05 11:34:29', 0),
(46, 17, 'You\'ve got a new message', 'chat', 13, '2025-08-05 11:34:30', 1),
(47, 17, 'You\'ve got a new message', 'chat', 13, '2025-08-05 11:34:30', 0),
(48, 17, 'You’ve got a new answer on your post', 'post', 26, '2025-08-05 11:34:39', 1),
(49, 13, 'You\'ve got a new message', 'chat', 17, '2025-08-06 03:10:16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `ID` bigint(20) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Content` text NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `AuthorID` bigint(20) DEFAULT NULL,
  `ModuleID` bigint(20) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`ID`, `Title`, `Content`, `Image`, `AuthorID`, `ModuleID`, `DateCreated`) VALUES
(21, 'Greeting! This is my first post on this Forum a', 'Hi everyone! 👋\r\n\r\nWelcome to the official forum for COMP-1841 – Web Programming 1. This space is for all of us to ask questions, share tips, post resources, and support each other as we learn HTML, CSS, JavaScript, and more.a\r\n\r\nFeel free to introduce yourself below — tell us your name, what you’re excited to build, or if you\'re new to coding.\r\nLet’s keep things respectful, helpful, and fun!\r\n\r\nLooking forward to seeing your creativity and progress. 🚀', '13/6891e50716acb8.35975521.png', 13, NULL, '2025-07-27 12:05:08'),
(38, 'Clarification on Coursework Requirements?', 'Hi everyone,\r\nI’m a bit confused about the coursework requirements for this term. Are we supposed to submit only the mid-fidelity prototype, or do we need to include the research and persona sections too? I’ve checked the brief, but it’s a bit vague.\r\nIf anyone can break it down or share a checklist of what they’re submitting, I’d really appreciate it. Thanks in advance!', '13/6892b18f692d71.35266418.png', 13, 9, '2025-08-05 11:21:55'),
(41, 'When is the Exact Submission Deadline?', 'Hey guys,\r\nQuick question: what’s the final submission deadline for our COMP1773 coursework? I saw one date on Moodle and heard a different one during the last lecture.\r\nCan someone confirm the exact date and time (and whether there’s a grace period)? Don’t want to risk submitting late 😅\n\nCan someone confirm the exact date and time (and whether there’s a grace period)? Don’t want to risk submitting late 😅', NULL, 18, 9, '2025-08-06 01:26:15'),
(42, 'Can We Work in Pairs or Groups?', 'Hi all,\r\nDoes anyone know if we’re allowed to collaborate on the coursework? Like working in pairs or small groups for the prototype? I know the report has to be individual, but I wasn’t sure about the app design or research part.\r\nWould be great to know, especially for bouncing ideas around. Thanks!\n\nI know the report has to be individual, but I wasn’t sure about the app design or research part.\r\nWould be great to know, especially for bouncing ideas around. Thanks!', NULL, 18, NULL, '2025-08-06 01:33:20'),
(43, 'Looking for Feedback on My App Idea', 'Hey team,\r\nI’m working on an app to reduce food waste by helping users track expiration dates and plan meals. I’m thinking of using voice input to log items quickly and maybe some AI to suggest recipes.\r\n\n\nDoes that sound like it fits the coursework scope? Any thoughts, suggestions, or concerns? Appreciate your feedback!', NULL, 17, 9, '2025-08-06 01:34:41'),
(44, 'Anyone Want to Review Each Other’s Work?', 'Hey,\r\nI’m almost done with my coursework prototype and report draft. I was wondering if anyone here wants to swap and review each other’s work for some last-minute feedback?\n\nJust informal peer review—could help both of us catch small mistakes or improve clarity. Let me know if interested!', NULL, 17, NULL, '2025-08-06 01:35:10');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `ID` smallint(6) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`ID`, `Name`) VALUES
(1, 'Admin'),
(5, 'Banned'),
(4, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` bigint(20) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `ProfilePicture` varchar(255) DEFAULT NULL,
  `Reputation` bigint(20) DEFAULT 0,
  `DateJoined` timestamp NOT NULL DEFAULT current_timestamp(),
  `About` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Username`, `Password`, `Email`, `Name`, `ProfilePicture`, `Reputation`, `DateJoined`, `About`) VALUES
(13, 'HuyNè', '$2y$10$sfDoRyqYvtgo5VqXRlThJuTGjOjLnc001y0uw3S8rAdFFo973YJN2', 'admin4@gmail.com', 'admin', '13/6892b19e915077.77605004.jpg', 0, '2025-07-21 14:54:33', 'Wherever there is knowledge, there are my bite marks.'),
(17, 'user1', '$2y$10$oBZx0zJVWJLtgtOCOreI9.NDNv67jppIff9DNdNSYEgr197IWum0q', 'user1@gmail.com', NULL, NULL, 0, '2025-08-04 09:45:37', NULL),
(18, 'user2', '$2y$10$020JELZvPK5DS3T24w1uGOrndG7xP7rDTSxZ6gr.u6UWr7b6EjgAy', 'user2@gmail.com', NULL, NULL, 0, '2025-08-05 11:27:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_badges`
--

CREATE TABLE `user_badges` (
  `ID` bigint(20) NOT NULL,
  `UserID` bigint(20) DEFAULT NULL,
  `BadgeID` bigint(20) NOT NULL,
  `DateEarned` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_badges`
--

INSERT INTO `user_badges` (`ID`, `UserID`, `BadgeID`, `DateEarned`) VALUES
(5, 13, 12, '2025-08-05 08:26:17'),
(6, 13, 15, '2025-08-05 12:18:03');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `UserID` bigint(20) NOT NULL,
  `RoleID` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`UserID`, `RoleID`) VALUES
(13, 1),
(17, 4),
(18, 4);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `ID` bigint(20) NOT NULL,
  `UserID` bigint(20) DEFAULT NULL,
  `PostID` bigint(20) NOT NULL,
  `VoteTypeID` bigint(20) NOT NULL,
  `DateVoted` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`ID`, `UserID`, `PostID`, `VoteTypeID`, `DateVoted`) VALUES
(3, 13, 21, 8, '2025-07-28 01:37:29');

-- --------------------------------------------------------

--
-- Table structure for table `vote_type`
--

CREATE TABLE `vote_type` (
  `ID` bigint(20) NOT NULL,
  `VoteType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vote_type`
--

INSERT INTO `vote_type` (`ID`, `VoteType`) VALUES
(9, 'down'),
(8, 'up');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminmessage`
--
ALTER TABLE `adminmessage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `AuthorID` (`AuthorID`),
  ADD KEY `FK_Answers_ParentAnswer` (`ParentAnswerID`),
  ADD KEY `FK_Answers_AcceptedAnswer` (`AcceptedAnswerID`),
  ADD KEY `answers_ibfk_2` (`PostID`);

--
-- Indexes for table `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SenderID` (`SenderID`),
  ADD KEY `ReceiverID` (`ReceiverID`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ModuleName` (`ModuleName`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idx_notifications_user` (`UserID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `AuthorID` (`AuthorID`),
  ADD KEY `ModuleID` (`ModuleID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `user_badges`
--
ALTER TABLE `user_badges`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UserID` (`UserID`,`BadgeID`),
  ADD KEY `BadgeID` (`BadgeID`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`UserID`,`RoleID`),
  ADD KEY `RoleID` (`RoleID`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UserID` (`UserID`,`PostID`),
  ADD KEY `VoteTypeID` (`VoteTypeID`),
  ADD KEY `votes_ibfk_2` (`PostID`);

--
-- Indexes for table `vote_type`
--
ALTER TABLE `vote_type`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `VoteType` (`VoteType`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminmessage`
--
ALTER TABLE `adminmessage`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `badges`
--
ALTER TABLE `badges`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `ID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_badges`
--
ALTER TABLE `user_badges`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vote_type`
--
ALTER TABLE `vote_type`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `FK_Answers_AcceptedAnswer` FOREIGN KEY (`AcceptedAnswerID`) REFERENCES `answers` (`ID`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_Answers_ParentAnswer` FOREIGN KEY (`ParentAnswerID`) REFERENCES `answers` (`ID`) ON DELETE SET NULL,
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`AuthorID`) REFERENCES `users` (`ID`) ON DELETE SET NULL,
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`PostID`) REFERENCES `posts` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`SenderID`) REFERENCES `users` (`ID`) ON DELETE SET NULL,
  ADD CONSTRAINT `conversations_ibfk_2` FOREIGN KEY (`ReceiverID`) REFERENCES `users` (`ID`) ON DELETE SET NULL;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`AuthorID`) REFERENCES `users` (`ID`) ON DELETE SET NULL,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`ModuleID`) REFERENCES `modules` (`ID`) ON DELETE SET NULL;

--
-- Constraints for table `user_badges`
--
ALTER TABLE `user_badges`
  ADD CONSTRAINT `user_badges_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`) ON DELETE SET NULL,
  ADD CONSTRAINT `user_badges_ibfk_2` FOREIGN KEY (`BadgeID`) REFERENCES `badges` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`) ON DELETE SET NULL,
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`PostID`) REFERENCES `posts` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_ibfk_3` FOREIGN KEY (`VoteTypeID`) REFERENCES `vote_type` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
