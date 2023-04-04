-- MariaDB dump 10.19  Distrib 10.5.18-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: db_sandbox_cms
-- ------------------------------------------------------
-- Server version	10.5.18-MariaDB-0+deb11u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cms_hierarchy`
--

DROP TABLE IF EXISTS `cms_hierarchy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_hierarchy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL,
  `obj_id` int(10) unsigned NOT NULL,
  `ord` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `updatetime` int(11) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT 0,
  `uri` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `is_default` (`is_default`),
  KEY `is_active` (`is_active`),
  KEY `ord` (`ord`),
  KEY `parent_id` (`parent_id`),
  KEY `updatetime` (`updatetime`),
  KEY `FK_hierarchy to plain object` (`obj_id`),
  CONSTRAINT `FK_hierarchy to plain object` FOREIGN KEY (`obj_id`) REFERENCES `cms_objects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_hierarchy`
--

LOCK TABLES `cms_hierarchy` WRITE;
/*!40000 ALTER TABLE `cms_hierarchy` DISABLE KEYS */;
INSERT INTO `cms_hierarchy` VALUES (1,0,1,1,1,NULL,0,'world'),(2,0,2,2,1,NULL,0,'sport'),(3,0,3,3,1,NULL,0,'politics'),(4,1,4,1,1,NULL,0,'trump_to_surrender_and_face_historic_criminal_charges_in_new_york_court'),(5,3,4,1,1,NULL,0,'trump_to_surrender_and_face_historic_criminal_charges_in_new_york_court'),(6,1,5,2,1,NULL,0,'around_the_world_criminal_charges_are_no_barrier_to_high_office'),(7,2,6,1,1,NULL,0,'football'),(8,2,7,2,1,NULL,0,'golf'),(9,7,8,1,1,NULL,0,'wrexham_announces_friendly_match_against_manchester_united_with_a_little_help_from_the_legendary_alex_ferguson'),(10,7,9,2,1,NULL,0,'cristiano_ronaldo_marks_two_goal_performance_with_new_celebration_against_luxembourg'),(11,8,10,1,1,NULL,0,'amir_malik_is_on_a_drive_to_make_golf_more_inclusive_for_muslims');
/*!40000 ALTER TABLE `cms_hierarchy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_object_news_item`
--

DROP TABLE IF EXISTS `cms_object_news_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_object_news_item` (
  `obj_id` int(10) unsigned NOT NULL,
  `title` varchar(1024) DEFAULT NULL,
  `anons` varchar(1024) DEFAULT NULL,
  `content` text DEFAULT NULL,
  PRIMARY KEY (`obj_id`),
  CONSTRAINT `FK_object_news_item to plain object` FOREIGN KEY (`obj_id`) REFERENCES `cms_objects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_object_news_item`
--

LOCK TABLES `cms_object_news_item` WRITE;
/*!40000 ALTER TABLE `cms_object_news_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_object_news_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_object_news_rubric`
--

DROP TABLE IF EXISTS `cms_object_news_rubric`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_object_news_rubric` (
  `obj_id` int(10) unsigned NOT NULL,
  `title` varchar(1024) DEFAULT NULL,
  `content` text DEFAULT NULL,
  PRIMARY KEY (`obj_id`),
  CONSTRAINT `FK_object_news_rubric to plain object` FOREIGN KEY (`obj_id`) REFERENCES `cms_objects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_object_news_rubric`
--

LOCK TABLES `cms_object_news_rubric` WRITE;
/*!40000 ALTER TABLE `cms_object_news_rubric` DISABLE KEYS */;
INSERT INTO `cms_object_news_rubric` VALUES (1,'World','Important events from around the world are presented in this section.'),(2,'Sport','Sports, events, athletes and achievements.'),(3,'Politics','This section is dedicated to political events in the world.'),(4,'Trump to surrender and face historic criminal charges in New York court','Former President Donald Trump plans to deliver brief comments — one short line, advisers tell CNN — before he enters the Manhattan courtroom this afternoon.\r\n\r\nWhile his aides said they hope that is the extent of his remarks until tonight when he speaks at Mar-a-Lago, they note that he could chart his own course.\r\n\r\nCNN reported earlier that advisers have urged him to hold off until he has the command of his own ballroom tonight, where hundreds of his supporters, surrogates and friends are expected to gather. Advisers have also warned Trump that any unplanned remarks put him at high risk of hurting his case. Trump’s Mar-a-Lago speech is expected to have legal eyes on it before he delivers it tonight.\r\n\r\nTrump has spent the morning on the phone with Republican allies, his tight circle of political advisers and his legal team, with an intensifying focus on what specific charges are contained in the sealed indictment. He cannot fully assess the political or legal road ahead until he learns just what, specifically, is in the indictment.\r\n\r\nAs he prepares to leave the Trump Tower shortly after lunchtime today, the former president will lose a measure of control that he has wielded over every political battle, tabloid scandal and business dealing for decades in Manhattan. After he surrenders – even in his defiance and not guilty plea – he will be a criminal defendant, something he has spent a lifetime trying to avoid.\r\n\r\nCNN\'s Kaitlan Collins and Kristen Holmes contributed reporting to this post.'),(5,'Around the world, criminal charges are no barrier to high office','\r\nDonald Trump may be the first former US president to face criminal charges, but around the world many current and former leaders have been prosecuted or even spent time in jail.\r\n\r\nMany of those leaders denounced the accusations against them as politically-motivated. But charges have often not been a barrier to holding political office.\r\n\r\nHere are some notable recent examples.\r\n\r\nNo one has served as Israeli prime minister longer than Benjamin Netanyahu, who was sworn in for his sixth term in the post late last year.\r\n\r\nThe prime minister is also currently facing a corruption trial, on charges of fraud, bribery and breach of trust. Some of the allegations assert that Netanyahu received gifts like cigars and champagne from overseas businessmen.\r\n\r\nEchoing some of the language used by Trump, Netanyahu has denied all the charges and called the trial a “witch hunt.”\r\n\r\nAs the case rumbles on, Netanyahu has been pushing a controversial plan to weaken Israel’s judicary.\r\n\r\nOne of the measures includes limits on the ways a sitting prime minister can be declared unfit for office, leading to many Israeli opposition politicians claiming that Netanyahu is using the judicial overhaul to protect himself. He denies the accusations.\r\n\r\nBrazil’s Luiz Inácio'),(6,'Football','All about football.'),(7,'Golf','All about golf.'),(8,'Wrexham announces friendly match against Manchester United – with a little help from the legendary Alex Ferguson','Manchester United and Wrexham announced they will be facing each other in a friendly later this year – with the help of a surprising sporting crossover.\r\n\r\nAppearing together on a video call, Wrexham’s Hollywood co-owners Ryan Reynolds and Rob McElhenney phoned legendary United manager Alex Ferguson to discuss the match, which will take place at San Diego’s Snapdragon Stadium on July 25.\r\n\r\nWrexham has risen to relative fame in the United States since Reynolds and McElhenney bought the Welsh club in November 2020, with the story of their takeover and first season in charge told in the hit documentary ‘Welcome to Wrexham.’\r\n\r\n“I can’t believe we’re about to talk with the Sir Alex Ferguson,” McElhenney says. “Arguably the greatest football manager ever. He’s won 13 Premier League titles.”\r\n\r\n“I know, I’m super nervous,” Reynolds replies. “I hear he is a master intimidator.”'),(9,'Cristiano Ronaldo marks two-goal performance with new celebration against Luxembourg','Cristiano Ronaldo scored twice as Portugal thrashed Luxembourg 6-0, marking his first goal with a new celebration.\r\n\r\nAfter bundling in Nuno Mendes’ headed pass from close range, Ronaldo ran to the corner flag to perform his iconic “Siu” celebration – pirouetting in the air before landing in a power stance.\r\n\r\nBut this time, he ended his goal-scoring routine by pretending to be asleep, an apparent reference to his habit of taking several naps a day.\r\n\r\nRonaldo provided a glimpse of the new celebration after scoring for Manchester United against Everton last year, and his former club said the 38-year-old’s sleeping position was a source of amusement to his teammates when the squad traveled to and from games.\r\n\r\nHis first-half brace for Portugal on Sunday takes Ronaldo’s tally for his country to 122 goals in 198 games having set the international appearance record against Liechtenstein three days before.'),(10,'Amir Malik is on a drive to make golf more inclusive for Muslims','Amir Malik is a man in love with golf. Yet golf has not always loved him back.\r\n\r\nA devoted sports fan since his childhood in Kingston upon Thames, London, he was fascinated with golf long before he took his first swing. But knowing nobody else who played, Malik settled for a sideline view.\r\n\r\nThat all changed in 2012, when his former boss invited him to try his hand at a driving range.\r\n\r\n“From the first ball I thought, ‘This is it. This game is incredible,’” Malik, now aged 38, told CNN.\r\n\r\n“I’ve played a lot of sports, but there aren’t too many when you go to bed thinking about it and you can’t wait to get up to go back and play again.”\r\n\r\nEventually, Malik was ready to take his game to the next level. Joining a municipal club in 2017, he began competing in Sunday morning tournaments.');
/*!40000 ALTER TABLE `cms_object_news_rubric` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_objects`
--

DROP TABLE IF EXISTS `cms_objects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_objects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(1024) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Object to type relation_FK` (`type`),
  KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_objects`
--

LOCK TABLES `cms_objects` WRITE;
/*!40000 ALTER TABLE `cms_objects` DISABLE KEYS */;
INSERT INTO `cms_objects` VALUES (1,'World','news_rubric'),(2,'Sport','news_rubric'),(3,'Politics','news_rubric'),(4,'Trump to surrender and face historic criminal charges in New York court','news_rubric'),(5,'Around the world, criminal charges are no barrier to high office','news_rubric'),(6,'Football','news_rubric'),(7,'Golf','news_rubric'),(8,'Wrexham announces friendly match against Manchester United – with a little help from the legendary Alex Ferguson','news_rubric'),(9,'Cristiano Ronaldo marks two-goal performance with new celebration against Luxembourg','news_rubric'),(10,'Amir Malik is on a drive to make golf more inclusive for Muslims','news_rubric');
/*!40000 ALTER TABLE `cms_objects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_search`
--

DROP TABLE IF EXISTS `cms_search`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_search` (
  `obj_id` int(10) unsigned NOT NULL,
  `itext` text DEFAULT NULL,
  PRIMARY KEY (`obj_id`),
  FULLTEXT KEY `search_itext` (`itext`),
  CONSTRAINT `FK_search to plain object` FOREIGN KEY (`obj_id`) REFERENCES `cms_objects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_search`
--

LOCK TABLES `cms_search` WRITE;
/*!40000 ALTER TABLE `cms_search` DISABLE KEYS */;
INSERT INTO `cms_search` VALUES (1,'world important events from around the world are presented in this section.'),(2,'sport sports, events, athletes and achievements.'),(3,'politics this section is dedicated to political events in the world.'),(4,'trump to surrender and face historic criminal charges in new york court former president donald trump plans to deliver brief comments — one short line, advisers tell cnn — before he enters the manhattan courtroom this afternoon.\r\n\r\nwhile his aides said they hope that is the extent of his remarks until tonight when he speaks at mar-a-lago, they note that he could chart his own course.\r\n\r\ncnn reported earlier that advisers have urged him to hold off until he has the command of his own ballroom tonight, where hundreds of his supporters, surrogates and friends are expected to gather. advisers have also warned trump that any unplanned remarks put him at high risk of hurting his case. trump’s mar-a-lago speech is expected to have legal eyes on it before he delivers it tonight.\r\n\r\ntrump has spent the morning on the phone with republican allies, his tight circle of political advisers and his legal team, with an intensifying focus on what specific charges are contained in the sealed indictment. he cannot fully assess the political or legal road ahead until he learns just what, specifically, is in the indictment.\r\n\r\nas he prepares to leave the trump tower shortly after lunchtime today, the former president will lose a measure of control that he has wielded over every political battle, tabloid scandal and business dealing for decades in manhattan. after he surrenders – even in his defiance and not guilty plea – he will be a criminal defendant, something he has spent a lifetime trying to avoid.\r\n\r\ncnn\'s kaitlan collins and kristen holmes contributed reporting to this post.'),(5,'around the world, criminal charges are no barrier to high office \r\ndonald trump may be the first former us president to face criminal charges, but around the world many current and former leaders have been prosecuted or even spent time in jail.\r\n\r\nmany of those leaders denounced the accusations against them as politically-motivated. but charges have often not been a barrier to holding political office.\r\n\r\nhere are some notable recent examples.\r\n\r\nno one has served as israeli prime minister longer than benjamin netanyahu, who was sworn in for his sixth term in the post late last year.\r\n\r\nthe prime minister is also currently facing a corruption trial, on charges of fraud, bribery and breach of trust. some of the allegations assert that netanyahu received gifts like cigars and champagne from overseas businessmen.\r\n\r\nechoing some of the language used by trump, netanyahu has denied all the charges and called the trial a “witch hunt.”\r\n\r\nas the case rumbles on, netanyahu has been pushing a controversial plan to weaken israel’s judicary.\r\n\r\none of the measures includes limits on the ways a sitting prime minister can be declared unfit for office, leading to many israeli opposition politicians claiming that netanyahu is using the judicial overhaul to protect himself. he denies the accusations.\r\n\r\nbrazil’s luiz inácio'),(6,'football all about football.'),(7,'golf all about golf.'),(8,'wrexham announces friendly match against manchester united – with a little help from the legendary alex ferguson manchester united and wrexham announced they will be facing each other in a friendly later this year – with the help of a surprising sporting crossover.\r\n\r\nappearing together on a video call, wrexham’s hollywood co-owners ryan reynolds and rob mcelhenney phoned legendary united manager alex ferguson to discuss the match, which will take place at san diego’s snapdragon stadium on july 25.\r\n\r\nwrexham has risen to relative fame in the united states since reynolds and mcelhenney bought the welsh club in november 2020, with the story of their takeover and first season in charge told in the hit documentary ‘welcome to wrexham.’\r\n\r\n“i can’t believe we’re about to talk with the sir alex ferguson,” mcelhenney says. “arguably the greatest football manager ever. he’s won 13 premier league titles.”\r\n\r\n“i know, i’m super nervous,” reynolds replies. “i hear he is a master intimidator.”'),(9,'cristiano ronaldo marks two-goal performance with new celebration against luxembourg cristiano ronaldo scored twice as portugal thrashed luxembourg 6-0, marking his first goal with a new celebration.\r\n\r\nafter bundling in nuno mendes’ headed pass from close range, ronaldo ran to the corner flag to perform his iconic “siu” celebration – pirouetting in the air before landing in a power stance.\r\n\r\nbut this time, he ended his goal-scoring routine by pretending to be asleep, an apparent reference to his habit of taking several naps a day.\r\n\r\nronaldo provided a glimpse of the new celebration after scoring for manchester united against everton last year, and his former club said the 38-year-old’s sleeping position was a source of amusement to his teammates when the squad traveled to and from games.\r\n\r\nhis first-half brace for portugal on sunday takes ronaldo’s tally for his country to 122 goals in 198 games having set the international appearance record against liechtenstein three days before.'),(10,'amir malik is on a drive to make golf more inclusive for muslims amir malik is a man in love with golf. yet golf has not always loved him back.\r\n\r\na devoted sports fan since his childhood in kingston upon thames, london, he was fascinated with golf long before he took his first swing. but knowing nobody else who played, malik settled for a sideline view.\r\n\r\nthat all changed in 2012, when his former boss invited him to try his hand at a driving range.\r\n\r\n“from the first ball i thought, ‘this is it. this game is incredible,’” malik, now aged 38, told cnn.\r\n\r\n“i’ve played a lot of sports, but there aren’t too many when you go to bed thinking about it and you can’t wait to get up to go back and play again.”\r\n\r\neventually, malik was ready to take his game to the next level. joining a municipal club in 2017, he began competing in sunday morning tournaments.');
/*!40000 ALTER TABLE `cms_search` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-04 19:49:07
