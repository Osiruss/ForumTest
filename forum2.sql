-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2015 at 03:54 PM
-- Server version: 5.6.17-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `forum2`
--

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE IF NOT EXISTS `forums` (
  `forum_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `parent_id` smallint(3) NOT NULL DEFAULT '0',
  `forum_group_id` int(11) NOT NULL,
  PRIMARY KEY (`forum_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`forum_id`, `title`, `description`, `parent_id`, `forum_group_id`) VALUES
(1, 'Gaming', 'Vestibulum suscipit nulla quis orci. Duis lobortis massa imperdiet quam. Proin faucibus arcu quis ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliq', 0, 3),
(2, 'Announcements', 'Phasellus gravida semper nisi. Sed aliquam ultrices mauris. Praesent egestas neque eu enim. Donec interdum, metus et hendrerit aliquet, dolor diam sagittis ligula, eget egestas libero turpis vel mi. N', 0, 1),
(3, 'TV & Movies', 'Fusce commodo aliquam arcu. Donec posuere vulputate arcu. Pellentesque libero tortor, tincidunt et, tincidunt eget, semper nec, quam. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Pellente', 0, 3),
(5, 'Off-topic', 'Maecenas ullamcorper dui et', 0, 2),
(6, 'Updates', 'Cras id dui. Aenean viverra rhoncus pede. Praesent congue erat at massa. Morbi ac felis. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis.', 0, 1),
(8, 'News', 'Nam at tortor in tellus interdum sagittis. Aenean commodo ligula eget dolor. In dui magna, posuere eget, vestibulum et, tempor auctor, justo. Aliquam lobortis. Proin faucibus arcu quis ante.', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `forum_groups`
--

CREATE TABLE IF NOT EXISTS `forum_groups` (
  `forum_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`forum_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `forum_groups`
--

INSERT INTO `forum_groups` (`forum_group_id`, `title`) VALUES
(1, 'Site News'),
(2, 'General'),
(3, 'Media');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `thread_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `message` text NOT NULL,
  `posted_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`post_id`),
  KEY `thread_id` (`thread_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=143 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `thread_id`, `user_id`, `message`, `posted_on`) VALUES
(1, 1, 1, 'After careful consideration of my to-do list', '2015-08-11 12:36:13'),
(2, 2, 5, 'This section describes the functions that can be used to manipulate temporal values. See Section 11.3, &ldquo;Date and Time Types&rdquo;, for a description of the range of values each date and time type has and the valid.', '2015-08-11 12:37:36'),
(3, 1, 5, 'In consectetuer turpis ut velit. Pellentesque egestas, neque sit amet convallis pulvinar, justo nulla eleifend augue, ac auctor orci leo non est. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Praesent porttitor, nulla vitae posuere iaculis, arcu nisl dignissim dolor, a pretium mi sem ut ipsum. Pellentesque habitant.\r\n\r\nPraesent egestas neque eu enim. Pellentesque libero tortor, tincidunt et, tincidunt eget, semper nec, quam. Vestibulum turpis sem, aliquet eget, lobortis pellentesque, rutrum eu, nisl. Cras id dui. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos.', '2015-08-11 13:06:54'),
(4, 2, 1, 'Completely renounce adulthood, and hide in a duvet fort watching cartoons and eating ice cream directly out of the tub until further notice.\r\n', '2015-08-11 13:47:38'),
(8, 3, 2, 'Vestibulum rutrum, mi nec elementum vehicula, eros quam gravida nisl, id fringilla neque ante vel mi. In auctor lobortis lacus. Duis leo. Phasellus a est. Curabitur turpis.', '2015-08-12 18:46:21'),
(9, 3, 1, 'What are you doing?', '2015-08-12 17:54:00'),
(10, 18, 1, 'KUt a nisl id ante tempus hendrerit. Vestibulum facilisis, purus nec pulvinar iaculis, ligula mi congue nunc, vitae euismod ligula urna in dolor. Curabitur vestibulum aliquam leo. Suspendisse pulvinar, augue ac venenatis condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Praesent venenatis metus at tortor pulvinar varius.', '2015-08-12 18:25:24'),
(11, 19, 4, 'PHP and MySQL for Dynamic Web Sites: The Forum! PHP and MySQL for Dynamic Web Sites: The Forum! PHP and MySQL for Dynamic Web Sites: The Forum!', '2015-08-12 18:28:27'),
(12, 19, 3, 'I don''t think so.', '2015-08-12 18:42:29'),
(13, 20, 3, 'You owe me a coke', '2015-08-12 19:01:56'),
(14, 21, 3, 'The header file will begin sessions and output buffering, while the footer file will end output buffering. Output buffering hasn&amp;rsquo;t been formally covered in the book, but it&amp;rsquo;s introduced sufficiently in the sidebar', '2015-08-13 08:40:04'),
(15, 21, 3, 'Nothing really matters.', '2015-08-13 09:19:43'),
(16, 22, 3, 'Curabitur turpis. Praesent ac massa at ligula laoreet iaculis. Sed hendrerit. Fusce fermentum odio nec arcu. Praesent egestas tristique nibh. Maecenas egestas arcu quis ligula mattis placerat. Duis lobortis massa imperdiet quam. Quisque id odio.', '2015-08-13 09:20:22'),
(18, 1, 1, 'This section describes the functions that can be used to manipulate temporal values. See Section 11.3, “Date and Time Types”, for a description of the range of values each date and time type has and the valid formats in which values may be specified.', '2015-09-25 20:31:45'),
(19, 19, 4, 'I didn''t use a book, but I have heard from people that this book was pretty decent.', '2015-09-26 13:26:49'),
(20, 18, 3, 'I didn''t use a book, but I have heard from people that this book was pretty decent.', '2015-09-26 13:30:00'),
(21, 12, 4, 'Two brothers find themselves lost in a mysterious land and try to find their way home. Animated series.\r\n', '2015-09-26 19:33:25'),
(22, 1, 3, 'Great summary of Paul Graham’s best Startup Advice http://buff.ly/1LdJref  @paulg #startups #advice', '2015-09-27 08:06:42'),
(23, 1, 5, 'After careful consideration of my to-do list', '2015-09-28 08:05:12'),
(24, 19, 4, 'After careful consideration of my to-do list', '2015-09-28 08:06:03'),
(25, 24, 3, 'The Message field is required.\r\n\r\nThe Subject field is required.', '2015-09-29 09:41:34'),
(26, 18, 3, 'Blah, Inc. 789 Folsom Ave, Suite 666\r\nSan Toronto, 481368 P: (123) 456-7890', '2015-09-29 20:40:31'),
(27, 20, 1, 'Maecenas malesuada. Fusce convallis metus id felis luctus adipiscing. Integer tincidunt. Ut a nisl id ante tempus hendrerit. Praesent blandit laoreet nibh.', '2015-09-29 20:42:28'),
(28, 24, 5, 'speaking of watching amazing b-movie-esque videos have you seen kung fury? truly glorious https://www.youtube.com/watch?v=bS5P_LAqiVg', '2015-09-30 06:30:27'),
(29, 25, 5, 'I see this error only after upgrading my PHP environment. The error points to this line of code: I see this error only after upgrading my PHP environment. The error points to this line of code:', '2015-09-30 06:59:14'),
(30, 26, 3, 'Aliquam eu nunc. Suspendisse pulvinar, augue ac venenatis condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Aliquam eu nunc. Suspendisse pulvinar, augue ac venenatis condimentu.', '2015-09-30 11:11:03'),
(31, 20, 3, 'Integer tincidunt. In ut quam vitae odio lacinia tincidunt. Maecenas malesuada.', '2015-09-30 11:44:28'),
(32, 27, 4, 'Pellentesque ut neque. In dui magna, posuere eget, vestibulum et, tempor auctor, justo. Nullam dictum felis eu pede mollis pretium. Phasellus dolor. Phasellus viverra nulla ut metus varius laoreet.', '2015-09-30 11:46:46'),
(33, 20, 4, 'Vestibulum turpis sem, aliquet eget, lobortis pellentesque, rutrum eu, nisl. Cras sagittis. Ut non enim eleifend felis pretium feugiat.Donec posuere vulputate arcu. Vestibulum purus quam, scelerisque ut, mollis sed.', '2015-09-30 12:08:32'),
(34, 28, 2, 'Phasellus consectetuer vestibulum elit. Vivamus quis mi. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Fusce pharetra convallis urna. Nunc nec neque.', '2015-10-02 09:21:56'),
(35, 20, 2, 'Pellentesque egestas, neque sit amet convallis pulvinar, justo nulla eleifend augue, ac auctor orci leo non est. Nulla porta dolor. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Duis leo. Vestibulum suscipit nulla quis orci.', '2015-10-02 12:14:00'),
(48, 19, 1, 'Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc nulla. Morbi mattis ullamcorper velit. Ut tincidunt tincidunt erat.', '2015-10-02 15:10:43'),
(50, 26, 1, 'Sed a libero. Maecenas egestas arcu quis ligula mattis placerat. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Etiam rhoncus. Ut tincidunt tincidunt erat.', '2015-10-02 15:12:44'),
(51, 28, 1, 'Pellentesque habitant morbi tristique', '2015-10-02 15:12:55'),
(52, 2, 1, 'Praesent congue erat at', '2015-10-02 15:13:18'),
(53, 32, 1, 'Nullam sagittis. Vestibulum turpis sem, aliquet eget, lobortis pellentesque, rutrum eu, nisl. Maecenas nec odio et ante tincidunt tempus. In turpis. Quisque malesuada placerat nisl.', '2015-10-02 15:59:03'),
(54, 12, 4, 'Phasellus volutpat metus eget', '2015-10-02 17:14:53'),
(56, 18, 4, 'Aenean viverra rhoncus pede', '2015-10-02 17:15:39'),
(57, 3, 4, 'Nunc nulla. Praesent egestas tristique nibh. Praesent nec nisl a purus blandit viverra. Curabitur nisi. Sed lectus.', '2015-10-02 17:15:55'),
(58, 24, 4, 'In ut quam vitae odio lacinia tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Praesent vestibulum dapibus nibh. Curabitur vestibulum aliquam leo. Curabitur nisi.', '2015-10-02 17:16:04'),
(59, 26, 4, 'Suspendisse nisl elit rhoncus', '2015-10-02 17:16:13'),
(60, 27, 5, 'In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Vestibulum rutrum, mi nec elementum vehicula, eros quam gravida nisl, id fringilla neque ante vel mi. Donec mollis hendrerit risus. Vestibulum suscipit nulla quis orci. Nunc sed turpis.', '2015-10-02 17:16:56'),
(61, 21, 5, 'Donec vitae sapien ut libero venenatis faucibus. Cras non dolor. Praesent porttitor, nulla vitae posuere iaculis, arcu nisl dignissim dolor, a pretium mi sem ut ipsum. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Integer tincidunt.', '2015-10-02 17:17:05'),
(62, 22, 3, 'Aenean viverra rhoncus pede. Phasellus a est. Sed aliquam ultrices mauris. Donec orci lectus, aliquam ut, faucibus non, euismod id, nulla. Vivamus.', '2015-10-02 17:17:25'),
(63, 25, 3, 'Praesent ac sem eget est egestas volutpat. Cras dapibus. Vivamus in erat ut urna cursus vestibulum. Phasellus gravida semper nisi. Vivamus laoreet.', '2015-10-02 17:17:35'),
(64, 22, 1, 'Maecenas malesuada. Aenean commodo ligula eget dolor. Phasellus nec sem in justo pellentesque facilisis. Phasellus consectetuer vestibulum elit. Duis leo.', '2015-10-02 21:03:33'),
(66, 1, 1, 'Phasellus volutpat, metus eget egestas mollis, lacus lacus blandit dui, id egestas quam mauris ut lacus. Cras id dui. Praesent metus tellus, elementum eu, semper a, adipiscing nec, purus. Aenean ut eros et nisl sagittis vestibulum. Fusce pharetra convallis urna.', '2015-10-02 21:17:16'),
(67, 28, 3, 'Sed aliquam ultrices mauris. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque id odio. Donec venenatis vulputate lorem.\r\n\r\nMaecenas vestibulum mollis diam. Praesent ut ligula non mi varius sagittis. Vestibulum volutpat pretium libero. Phasellus gravida semper nisi. Vestibulum ullamcorper mauris at ligula.\r\n\r\nSed a libero. Cras dapibus. Cras ultricies mi eu turpis hendrerit fringilla. Pellentesque auctor neque nec urna. Praesent venenatis metus at tortor pulvinar varius.\r\n\r\nDonec vitae sapien ut libero venenatis faucibus. Curabitur blandit mollis lacus. Phasellus ullamcorper ipsum rutrum nunc. Phasellus accumsan cursus velit. Maecenas egestas arcu quis ligula mattis placerat.\r\n\r\nIn hac habitasse platea dictumst. Phasellus gravida semper nisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Cras non dolor. Sed magna purus, fermentum eu, tincidunt eu, varius ut.', '2015-10-03 07:49:16'),
(71, 22, 10, 'Pellentesque ut neque. Vestibulum suscipit nulla quis orci. Aliquam erat volutpat. In dui magna, posuere eget, vestibulum et, tempor auctor, justo. Nulla porta dolor.', '2015-10-03 11:19:42'),
(72, 33, 10, 'Fusce vel dui. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. Etiam iaculis nunc ac metus. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Nulla consequat massa quis enim.\r\n\r\nSed augue ipsum, egestas nec, vestibulum et, malesuada adipiscing, dui. Sed libero. Nullam dictum felis eu pede mollis pretium. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Fusce fermentum odio nec arcu.\r\n\r\nFusce convallis metus id felis luctus adipiscing. Fusce fermentum. Etiam vitae tortor. Nam commodo suscipit quam. Nunc nulla.\r\n\r\nInteger tincidunt. Fusce convallis metus id felis luctus adipiscing. Nullam dictum felis eu pede mollis pretium. Maecenas malesuada. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.\r\n\r\nNunc interdum lacus sit amet orci. Duis leo. Sed mollis, eros et ultrices tempus, mauris ipsum aliquam libero, non adipiscing dolor urna a orci. Cras sagittis. Vivamus aliquet elit ac nisl.', '2015-10-03 11:20:05'),
(73, 34, 2, 'Maecenas vestibulum mollis diam. Donec interdum, metus et hendrerit aliquet, dolor diam sagittis ligula, eget egestas libero turpis vel mi. Suspendisse enim turpis, dictum sed, iaculis a, condimentum nec, nisi. Aenean massa. Nam pretium turpis et arcu.', '2015-10-03 17:14:11'),
(75, 20, 2, 'Nam ipsum risus, rutrum vitae, vestibulum eu, molestie vel, lacus. Suspendisse non nisl sit amet velit hendrerit rutrum. Aliquam lobortis. Suspendisse enim turpis, dictum sed, iaculis a, condimentum nec, nisi. Nulla facilisi.', '2015-10-03 18:33:46'),
(76, 1, 2, 'Nunc nec neque. Nullam sagittis. Etiam rhoncus. Etiam imperdiet imperdiet orci. Phasellus a est.\r\n\r\nUt a nisl id ante tempus hendrerit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Etiam vitae tortor. Curabitur at lacus ac velit ornare lobortis. Pellentesque libero tortor, tincidunt et, tincidunt eget, semper nec, quam.\r\n\r\nVestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Phasellus viverra nulla ut metus varius laoreet. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Phasellus dolor. Pellentesque posuere.\r\n\r\nDonec mollis hendrerit risus. Praesent egestas tristique nibh. Vivamus euismod mauris. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. Duis lobortis massa imperdiet quam.\r\n\r\nDonec vitae orci sed dolor rutrum auctor. Nunc interdum lacus sit amet orci. Nam commodo suscipit quam. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Pellentesque egestas, neque sit amet convallis pulvinar, justo nulla eleifend augue, ac auctor orci leo non.', '2015-10-03 18:39:54'),
(77, 36, 2, 'Nulla neque dolor, sagittis eget, iaculis quis, molestie non, velit. Vivamus elementum semper nisi. Praesent venenatis metus at tortor pulvinar varius. Vivamus elementum semper nisi. Aenean ut eros et nisl sagittis vestibulum.', '2015-10-03 21:27:24'),
(78, 18, 2, 'Donec posuere vulputate arcu. Etiam feugiat lorem non metus. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Cras dapibus. Nunc nonummy metus.', '2015-10-03 21:27:49'),
(79, 37, 5, 'Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Curabitur vestibulum aliquam leo. Cras ultricies mi eu turpis hendrerit fringilla. Phasellus tempus. Etiam iaculis nunc ac metus.', '2015-10-03 21:28:12'),
(80, 38, 10, 'Nam adipiscing. Fusce convallis metus id felis luctus adipiscing. Proin faucibus arcu quis ante. Sed lectus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis.\r\n\r\nNunc interdum lacus sit amet orci. Curabitur suscipit suscipit tellus. Morbi vestibulum volutpat enim. Vivamus quis mi. Donec interdum, metus et hendrerit aliquet, dolor diam sagittis ligula, eget egestas libero turpis vel mi.\r\n\r\nSuspendisse feugiat. Fusce pharetra convallis urna. Vestibulum ullamcorper mauris at ligula. Curabitur nisi. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor.\r\n\r\nEtiam imperdiet imperdiet orci. Praesent metus tellus, elementum eu, semper a, adipiscing nec, purus. Praesent nonummy mi in odio. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Fusce convallis metus id felis luctus adipiscing.\r\n\r\nAenean tellus metus, bibendum sed, posuere ac, mattis non, nunc. Fusce convallis metus id felis luctus adipiscing. Etiam iaculis nunc ac metus. Praesent adipiscing. Ut tincidunt tincidunt erat.', '2015-10-03 21:28:52'),
(81, 39, 10, 'Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Praesent blandit laoreet nibh. Quisque libero metus, condimentum nec, tempor a, commodo mollis, magna. Vestibulum ullamcorper mauris at ligula. Praesent nonummy mi in odio.', '2015-10-03 21:29:10'),
(82, 39, 4, 'Phasellus a est. Fusce fermentum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus. Curabitur nisi. Nullam vel sem.', '2015-10-03 21:29:45'),
(84, 34, 10, 'Suspendisse nisl elit, rhoncus eget, elementum ac, condimentum eget, diam. Sed in libero ut nibh placerat accumsan. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Nunc nulla. Phasellus volutpat, metus eget egestas mollis, lacus lacus blandit dui, id egestas quam mauris ut lacus.', '2015-10-04 20:03:03'),
(85, 1, 2, 'Etiam feugiat lorem non metus. Integer tincidunt. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Sed hendrerit. Cras varius.', '2015-10-04 20:44:30'),
(87, 41, 11, 'Fusce convallis metus id felis luctus adipiscing. Aenean commodo ligula eget dolor. \r\n\r\nFusce pharetra convallis urna. Pellentesque dapibus hendrerit tortor. Nullam tincidunt adipiscing enim.', '2015-10-04 21:00:02'),
(88, 39, 11, 'Aliquam erat volutpat. Sed cursus turpis vitae tortor. Phasellus volutpat, metus eget egestas mollis, lacus lacus blandit dui, id egestas quam mauris ut lacus. Donec interdum, metus et hendrerit aliquet, dolor diam sagittis ligula, eget egestas libero turpis vel mi. Pellentesque posuere.', '2015-10-04 21:01:08'),
(89, 25, 15, 'Curabitur vestibulum aliquam leo. Curabitur vestibulum aliquam leo. Vivamus consectetuer hendrerit lacus. Proin magna. In ut quam vitae odio lacinia tincidunt.', '2015-10-05 10:54:46'),
(90, 1, 3, 'Sed fringilla mauris sit amet nibh. Phasellus gravida semper nisi. Fusce a quam. Aenean massa. Phasellus dolor.', '2015-10-05 16:08:30'),
(91, 1, 3, 'Etiam sit amet orci', '2015-10-05 17:37:07'),
(92, 28, 3, 'Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Etiam vitae tortor. Donec mollis hendrerit risus. Donec vitae orci sed dolor rutrum auctor. Suspendisse enim turpis, dictum sed, iaculis a, condimentum nec, nisi.', '2015-10-05 17:37:23'),
(93, 3, 3, 'Donec mi odio, faucibus at, scelerisque quis, convallis in, nisi. Fusce vel dui. In consectetuer turpis ut velit. Aliquam erat volutpat. Maecenas egestas arcu quis ligula mattis placerat.', '2015-10-05 17:50:28'),
(94, 19, 3, 'Aenean imperdiet. Quisque malesuada placerat nisl. Cras id dui. In hac habitasse platea dictumst. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.', '2015-10-05 17:50:46'),
(95, 42, 4, 'Donec orci lectus, aliquam ut, faucibus non, euismod id, nulla. Morbi mattis ullamcorper velit. Praesent egestas neque eu enim. Donec vitae sapien ut libero venenatis faucibus. Phasellus tempus.', '2015-10-05 18:19:47'),
(96, 1, 4, 'Nunc nec neque. Pellentesque posuere. Sed libero. Mauris sollicitudin fermentum libero. Maecenas egestas arcu quis ligula mattis placerat.', '2015-10-05 18:56:40'),
(97, 28, 4, 'Fusce convallis metus id felis luctus adipiscing. Phasellus blandit leo ut odio. Fusce fermentum. Vestibulum turpis sem, aliquet eget, lobortis pellentesque, rutrum eu, nisl. Morbi vestibulum volutpat enim.', '2015-10-05 18:57:37'),
(98, 28, 4, 'Duis leo. Nam eget dui. Praesent nonummy mi in odio. Cras id dui. Pellentesque auctor neque nec urna.', '2015-10-05 18:59:29'),
(99, 20, 4, 'Aenean vulputate eleifend tellus. Fusce vulputate eleifend sapien. Vivamus in erat ut urna cursus vestibulum. Donec posuere vulputate arcu. Nam pretium turpis et arcu.', '2015-10-05 19:29:17'),
(110, 28, 10, 'Vivamus elementum semper nisi. Aenean imperdiet. Phasellus dolor. In ut quam vitae odio lacinia tincidunt. Curabitur ullamcorper ultricies nisi.', '2015-10-05 19:38:35'),
(114, 26, 10, 'Nam pretium turpis et', '2015-10-05 19:43:34'),
(124, 1, 10, 'Nullam accumsan lorem in dui. Suspendisse non nisl sit amet velit hendrerit rutrum. Vestibulum facilisis, purus nec pulvinar iaculis, ligula mi congue nunc, vitae euismod ligula urna in dolor. Etiam iaculis nunc ac metus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.', '2015-10-05 20:01:43'),
(125, 18, 10, 'Duis lobortis massa imperdiet quam. Etiam rhoncus. Aenean vulputate eleifend tellus. Quisque malesuada placerat nisl. Donec vitae sapien ut libero venenatis faucibus.', '2015-10-05 20:01:58'),
(126, 26, 16, 'Donec mollis hendrerit risus. Aliquam eu nunc. Praesent turpis. In ac felis quis tortor malesuada pretium. Vestibulum dapibus nunc ac augue.', '2015-10-05 20:04:11'),
(127, 26, 16, 'Donec mollis hendrerit risus. Donec orci lectus, aliquam ut, faucibus non, euismod id, nulla. Duis leo. Duis lobortis massa imperdiet quam. Etiam feugiat lorem non metus.', '2015-10-05 20:04:19'),
(128, 18, 16, 'Duis leo. Nunc sed turpis. Praesent nonummy mi in odio. Ut non enim eleifend felis pretium feugiat. Praesent venenatis metus at tortor pulvinar varius.', '2015-10-05 20:12:40'),
(129, 41, 16, 'Quisque malesuada placerat nisl. Donec id justo. Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc. Etiam ultricies nisi vel augue. Nam at tortor in tellus interdum sagittis.', '2015-10-05 20:31:33'),
(131, 41, 16, 'Phasellus viverra nulla ut metus varius laoreet. Vestibulum eu odio. Vestibulum fringilla pede sit amet augue. Donec interdum, metus et hendrerit aliquet, dolor diam sagittis ligula, eget egestas libero turpis vel mi. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris.', '2015-10-06 07:58:41'),
(133, 44, 17, 'Vestibulum ullamcorper mauris at ligula. Praesent egestas neque eu enim. Praesent vestibulum dapibus nibh. Praesent ut ligula non mi varius sagittis. Praesent nec nisl a purus blandit viverra.\r\n\r\nEtiam iaculis nunc ac metus. Aenean viverra rhoncus pede. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Donec mi odio, faucibus at, scelerisque quis, convallis in, nisi. Maecenas egestas arcu quis ligula mattis placerat.', '2015-10-15 16:37:42'),
(134, 34, 11, 'Etiam ut purus mattis mauris sodales aliquam. Praesent nonummy mi in odio. Fusce fermentum odio nec arcu. Curabitur turpis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.', '2015-10-15 19:43:52'),
(136, 46, 10, 'Duis vel nibh at velit scelerisque suscipit. Sed hendrerit. Sed mollis, eros et ultrices tempus, mauris ipsum aliquam libero, non adipiscing dolor urna a orci. Nam adipiscing. Etiam iaculis nunc ac metus.', '2015-10-17 15:28:25'),
(137, 46, 17, 'Sed lectus. Maecenas egestas arcu quis ligula mattis placerat. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Nulla facilisi. Vestibulum fringilla pede sit amet augue.', '2015-10-17 15:29:08'),
(138, 47, 17, 'Etiam imperdiet imperdiet orci. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Praesent metus tellus, elementum eu, semper a, adipiscing nec, purus. Sed lectus. Nunc nonummy metus.\r\n\r\nCras ultricies mi eu turpis hendrerit fringilla. Ut leo. Quisque id mi. Sed in libero ut nibh placerat accumsan. Curabitur suscipit suscipit tellus.\r\n\r\nEtiam imperdiet imperdiet orci. Pellentesque ut neque. Donec vitae sapien ut libero venenatis faucibus. Suspendisse nisl elit, rhoncus eget, elementum ac, condimentum eget, diam. Morbi mattis ullamcorper velit.\r\n\r\nProin faucibus arcu quis ante. Nulla sit amet est. Fusce ac felis sit amet ligula pharetra condimentum. Duis lobortis massa imperdiet quam. Curabitur ullamcorper ultricies nisi.\r\n\r\nNullam sagittis. Pellentesque egestas, neque sit amet convallis pulvinar, justo nulla eleifend augue, ac auctor orci leo non est. In auctor lobortis lacus. Donec sodales sagittis magna. In hac habitasse platea dictums', '2015-10-17 15:31:19'),
(140, 49, 10, 'In ut quam vitae odio lacinia tincidunt. Mauris turpis nunc, blandit et, volutpat molestie, porta ut, ligula. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec vitae sapien ut libero venenatis faucibus. Morbi vestibulum volutpat enim.\r\n\r\nDuis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Nulla porta dolor. Vestibulum volutpat pretium libero. Pellentesque egestas, neque sit amet convallis pulvinar, justo nulla eleifend augue, ac auctor orci leo non est. Sed lectus.\r\n\r\nVestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Pellentesque egestas, neque sit amet convallis pulvinar, justo nulla eleifend augue, ac auctor orci leo non est. Aliquam erat volutpat. Nunc nonummy metus. Etiam sit amet orci eget eros faucibus tincidunt.\r\n\r\nVestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus. Nulla consequat massa quis enim. Etiam ultricies nisi vel augue. Nam ipsum risus, rutrum vitae, vestibulum eu, molestie vel, lacus. Praesent congue erat at massa.\r\n\r\nEtiam ultricies nisi vel augue. Praesent turpis. Suspendisse enim turpis, dictum sed, iaculis a, condimentum nec, nisi. Vestibulum fringilla pede sit amet augue. Nullam tincidunt adipiscing enim.', '2015-10-17 19:31:17'),
(141, 42, 10, 'Praesent blandit laoreet nibh. Phasellus ullamcorper ipsum rutrum nunc. Maecenas malesuada. Vivamus in erat ut urna cursus vestibulum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.', '2015-10-19 08:39:07'),
(142, 42, 20, 'Ut varius tincidunt libero. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Phasellus ullamcorper ipsum rutrum nunc. Vestibulum fringilla pede sit amet augue. Fusce ac felis sit amet ligula pharetra condimentum.', '2015-10-19 11:51:34');

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE IF NOT EXISTS `temp` (
  `temp_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`temp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `temp`
--

INSERT INTO `temp` (`temp_id`, `code`, `user_id`) VALUES
(19, '042000309207', 19);

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE IF NOT EXISTS `threads` (
  `thread_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `forum_id` tinyint(3) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `subject` varchar(150) NOT NULL,
  `latest_post_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`thread_id`),
  KEY `lang_id` (`forum_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`thread_id`, `forum_id`, `user_id`, `subject`, `latest_post_date`) VALUES
(1, 2, 1, 'First ever thread, seriously', '2015-10-05 20:01:43'),
(2, 1, 5, 'The overarching structure of this query', '2015-10-02 15:13:18'),
(3, 2, 1, 'Monitor fliashing on startup/hibernation for night', '2015-10-05 17:50:28'),
(12, 1, 1, 'What to do what to do', '2015-10-02 17:14:53'),
(18, 1, 1, 'Billing', '2015-10-06 07:25:22'),
(19, 2, 4, 'This is a brand new thread. Sup.', '2015-10-05 17:50:46'),
(20, 1, 3, 'Jinx', '2015-10-05 19:29:17'),
(21, 1, 3, 'No.', '2015-10-02 17:17:05'),
(22, 1, 3, 'monster hunter', '2015-10-03 11:19:42'),
(24, 2, 3, 'Monitor fliashing on startup/hibernation for night', '2015-10-02 17:16:04'),
(25, 2, 5, 'I see this error only after upgrading my PHP environment. The error points to this line of code:', '2015-10-05 10:54:46'),
(26, 3, 3, 'Aliquam eu nunc. Suspendisse pulvinar.', '2015-10-05 20:04:19'),
(27, 2, 4, 'Integer tincidunt. In ut quam', '2015-10-02 17:16:56'),
(28, 3, 2, 'Donec mollis hendrerit risu', '2015-10-05 19:38:35'),
(32, 1, 1, 'Morbi mattis ullamcorper velit', '2015-10-02 15:59:03'),
(33, 3, 10, 'Nam ipsum risus rutrum', '2015-10-03 11:20:05'),
(34, 3, 2, 'Vestibulum facilisis purus nec', '2015-10-15 19:43:52'),
(36, 1, 2, 'Fusce commodo aliquam arcu', '2015-10-03 21:27:24'),
(37, 1, 5, 'Donec venenatis vulputate lorem', '2015-10-03 21:28:12'),
(38, 1, 10, 'Pellentesque libero tortor tincidunt', '2015-10-03 21:28:52'),
(39, 1, 10, 'Morbi vestibulum volutpat enim', '2015-10-05 19:50:20'),
(41, 3, 11, 'Integer ante arcu accumsan', '2015-10-06 07:58:41'),
(42, 2, 4, 'Donec venenatis vulputate lorem', '2015-10-19 11:51:34'),
(44, 2, 17, 'Phasellus leo dolor tempus', '2015-10-15 16:37:42'),
(46, 6, 10, 'Pellentesque habitant morbi tristique', '2015-10-17 15:29:09'),
(47, 3, 17, 'Hrcu. Curabitur nisi. Praesent ut ligula non mi varius sagittis.', '2015-10-17 15:31:19'),
(49, 8, 10, 'Praesent egestas neque eu', '2015-10-17 19:31:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `active` int(11) NOT NULL DEFAULT '0',
  `last_active` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `group_id` int(11) NOT NULL DEFAULT '2',
  `joined` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(30) NOT NULL,
  `pass` char(255) NOT NULL,
  `email` varchar(60) NOT NULL,
  `bio` text NOT NULL,
  `avatar` varchar(100) NOT NULL DEFAULT 'default.png',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `login` (`username`,`pass`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `active`, `last_active`, `group_id`, `joined`, `username`, `pass`, `email`, `bio`, `avatar`) VALUES
(1, 1, '2015-10-17 10:17:24', 2, '2015-08-04 07:40:18', 'troutster', 'wVzOFdJaYBJx16nljoNYhGwu1bURfGofQAH+TpkR7ZsMfWEQ81DRwtg1D7h/9wuYsINyOXUf3LkVLlx5dLkwDQ==', 'email@example.com', 'Aliquam eu nunc. Suspendisse pulvinar, augue ac venenatis condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis.', '1_thumb.jpg'),
(2, 1, '2015-10-17 11:26:03', 2, '2015-08-05 09:09:48', 'Ute', 'SdRfijHSnJEH+6KIn1wAxhgn/m9cXsWMCfcfB6WkRpqQgmuNpDP1K6vkr9m6RAHqDa7Fg6qmn1MXTItH9CjX0A==', 'email1@example.com', 'Suspendisse pulvinar, augue ac venenatis condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia.', '2_thumb.jpg'),
(3, 1, '2015-10-17 09:38:45', 2, '2015-08-06 15:00:00', 'Silje', 'uZsGUoqHwz65zDrKGXv5TcvDSOq4plGtfxzbfaTWIhUoFwx0/pUSYWy6ptDYWuhL0CcmssLbiagMfIhZj/ZGQw==', 'email2@example.com', 'Vestibulum ullamcorper mauris at ligula. Curabitur at lacus ac velit ornare lobortis. Sed mollis, eros et ultrices tempus, mauris ipsum aliquam libero, non adipiscing dolor urna a orci. Vestibulum rutrum, mi nec elementum vehicula, eros quam gravida nisl, id fringilla neque ante vel mi. Praesent porttitor, nulla vitae posuere iaculis, arcu nisl dignissim dolor, a pretium mi sem ut ipsum.', '3_thumb.png'),
(4, 1, '2015-10-17 09:38:45', 2, '2015-08-06 20:17:26', 'Joao', 'nFRsbefHbMjhI/bTXXmY5Hr4miEhoyWT83ADIXMQbYkm8JEb2r4IyztAO9uxppH7Nl2F5A6wMCdIRz7zfBENyg==', 'email3@example.com', 'Proin magna. Sed augue ipsum, egestas nec, vestibulum et, malesuada adipiscing, dui. Integer tincidunt.', '4_thumb.png'),
(5, 1, '2015-10-17 09:38:45', 2, '2015-08-07 10:26:14', 'kiwi', 'zTVXr30cG1+brCl++vYPY7soFTTHSGX5vUnHnCDdddg1f9I1n0gAm93W14BZ4kOa7K/fG8Uf++jfgJSnKFgECQ==', 'kiwi@example.org', 'Praesent congue erat at massa. Phasellus dolor. Duis leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Fusce ac felis sit amet ligula pharetra condimentum.', '5_thumb.jpg'),
(10, 1, '2015-10-19 09:44:20', 1, '2015-10-03 11:18:14', 'houdini', 'RiJ5UcH4xuZ29UkHeWfQSym+4xawPuyy7RrzR6RIc9FmmUVChj3su8OPXN/Vfz0v3SV/oUCppvrPDq4BACe/ZA==', 'houdini@example.com', 'Pellentesque ut neque. Vestibulum suscipit nulla quis orci. Aliquam erat volutpat. In dui magna, posuere eget, vestibulum et, tempor auctor, justo. Nulla porta dolor.', '10_thumb.png'),
(11, 1, '2015-10-19 08:38:40', 2, '2015-10-04 20:59:16', 'roott', 'NoA/x/jlHx35BJh0DO06H1DPSkevrfT0yH0BDh7wqlH4o3/qwBkwZyeZcxph6itwy0VnJPpSeE0eAZ3GyOQVGg==', 'test@domain.tld', 'Curabitur blandit mollis lacus. Fusce a quam. Nulla facilisi. Nulla porta dolor. Sed augue ipsum, egestas nec, vestibulum et, malesuada adipiscing, dui.\r\n\r\nCurabitur blandit mollis lacus. Fusce a quam. Nulla facilisi. Nulla porta dolor. Sed augue ipsum, egestas nec, vestibulum et, malesuada adipiscing, dui.', '11_thumb.jpg'),
(15, 1, '2015-10-17 09:38:45', 2, '2015-10-05 10:48:51', 'noone', 'c51sT2QBv0MurOnh5+y2w+4xr0xrvj7GPsprWSpFsADTP57PCsORnaLQyScfIsiRyRV0G1LX2VTMW2FZbvNmVg==', 'noone@no.om', '', 'default.png'),
(16, 1, '2015-10-19 08:52:20', 2, '2015-10-05 11:31:35', 'Yulio', 'fudH78HNp8VCbaCb1NXByJg3UnB3lXycD+UJNebYMvgtokypCqTDUEkDnjchFrz6XUn2kZ+C9HELSPSvlys4vQ==', 'test@domain.t', 'Donec venenatis vulputate lorem. In turpis. Etiam imperdiet imperdiet orci. Proin pretium, leo ac pellentesque mollis, felis nunc ultrices eros, sed gravida augue augue mollis justo. In hac habitasse platea dictumst.', '16_thumb.jpg'),
(17, 1, '2015-10-17 18:06:21', 2, '2015-10-15 16:32:30', 'sarah', 'eTDOeGR+PVlDUYvXit7oaflxO1UYLUzEJyqHvko6wx4+gZ+zXwwcfYoBS7Z9EFAMATXJjr2jhDnX7pDADahFpQ==', 'sarah@gm.co', 'Nam ipsum risus, rutrum vitae, vestibulum eu, molestie vel, lacus. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur blandit mollis lacus. Ut leo. Suspendisse eu ligula.', '17_thumb.png'),
(18, 1, '2015-10-17 09:38:45', 2, '2015-10-16 08:29:19', 'ashley', 'P/0fapvfV5fc+N6SdHrk0SOxUJt0w+oWpcUdTdmJxBqaBSBffp3AiI8XQv4h0jMI7e73De2vSb7JBVWd0k6l1w==', 'ash@hm.lo', '', 'default.png'),
(19, 0, '2015-10-17 09:38:45', 2, '2015-10-16 10:37:29', 'jeremy', 'qCc595N8im+/Hdlawd10znmqY7OPRo7QZGmBzzqDMyrToBh2SK+PBqReOyQniu7+UHgM56c23BqzdPTOfLMICg==', 'jeremy@h.kl', '', 'default.png'),
(20, 1, '2015-10-19 12:02:55', 2, '2015-10-16 10:39:01', 'chloe', 'XeNz7jn/+QFA8SXPhAjG8GW0YsgMOGShW8rToxNdLMpVaMBLDazGJbIpORgbSz0J2T66lNqkteidlIoBxIYqYg==', 'chlo@hj.kl', '', 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE IF NOT EXISTS `user_groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`group_id`, `title`) VALUES
(1, 'admin'),
(2, 'user');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
