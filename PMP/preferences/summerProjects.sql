-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2014 at 06:20 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cfi-2014`
--

-- --------------------------------------------------------

--
-- Table structure for table `summerprojects`
--

CREATE TABLE IF NOT EXISTS `summerprojects` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `summerprojects`
--

INSERT INTO `summerprojects` (`id`, `title`, `description`, `category`) VALUES
(1, 'Innovative Compass', 'To remove the concept of compass and make an adjustable circular rigid wire', 'Creative Ideas'),
(2, 'Smart Band', 'To make an automatic or manually controlled bot that measures the pulse rate,temperature,respiration rate and blood pressure and reports the data', 'Creative Ideas'),
(3, 'Connecting Laptops & Phones', 'A USB cable which connects laptops.Using pendrive to transfer files from one laptop to other is a time taking process.\r\nInstead we can use USB like we connect phone to laptop. This can even extend to sharing charge between laptops and phones', 'Creative Ideas'),
(4, 'Sound Distillator', 'A device which identifies all the audible sounds in a person current surroundings and can filter or isolate the desired sound and allow only that sound to be audible to the person ( ideally a device like an earphone and controlled through a mobile phone ).', 'Creative Ideas'),
(5, '3D Calling', 'Using skype and hologram technology hope we can bring a technology such that the person seen in laptop can be focused.\r\nat a place and all his movements are same as that in laptop but that appears as a real beside you', 'Creative Ideas'),
(6, 'Duster Cleaner', 'Duster cleaning machine which starts working as soon as duster is kept over it without making noise', 'Creative Ideas'),
(7, 'Clothes Dryer', 'A machine for drying clothes after washing instead of hanging them. Drying a couple of clothes together within reasonable time and with less power consumption', 'Creative Ideas'),
(8, 'Protection of eyes from light coming from the headlights of vehicles', 'To make a glass which can protect us from the headlight of other vehicles', 'Creative Ideas'),
(9, 'Device to clean black board', 'A device which cleans the whole blackboard perfectly when a switch is pressed.It fits to the board and slides from one end to the another cleaning the board', 'Creative Ideas'),
(10, 'Roommate friendly alarm clock', 'Build an alarm clock which would only wake the person concerned without disturbing people around', 'Creative Ideas'),
(11, 'Helmet Lock', 'A helmet that also acts as a lock and makes sure that the bike starts only after the helmet is worn', 'Creative Ideas'),
(12, 'Safety necklace for swimmer', 'Project aims at making a necklace which can turn into life saving device during swimming, at appropriate time. It can be of great help to learners and deep sea divers', 'Creative Ideas'),
(13, 'Stress Reliever', 'Make a skull like structure that according to various level of stress that we set it to can give a smooth massage on the head concentrating on those areas that gives better effect, with some soothing music played in an ear phone attached to it', 'Creative Ideas'),
(14, 'Conservation of electricity', 'would detect the presence of human in a room and code accordingly to switch on/off lights ', ' Electronics & Android'),
(15, 'Tracking Device', 'This project is mainly aimed at making very cheap emitters that can be installed in commercial and residential buildings to assist in echolocation(the receiver being a standard smartphone with or without an attachment) for people with visual impairment. A device that tells us the location of the thing we are searching for ', ' Electronics & Android'),
(16, 'Confirming home security', 'Build a device which will reply to a text message sent by a mobile (after clearing the username and password checks.).checking whether all the doors and windows are locked. This can also be extended to check whether the doors alone are locked during night when the person is sleeping inside the house', ' Electronics & Android'),
(17, 'The Insti app', 'Most of us miss insti,dept or hostel events just because we dont frequently check notice boards or mail.\r\nThe idea is to make an app which automatically adds remainders for all the events conducted across the insti and make it possible to manage our busy schedule with this app with features like.\r\n\r\n1.Attendance manager(shows % for each of your course )\r\n2.Deadline Box(Makes sure we don''t miss deadlines for imp events and submissions)._\r\n3.Manage Extra-curricular activities like-TechSoc,LitSoc, CFI, SCHROETER etc.\r\n4.Auto silent mode during classes (and of course back to normal after class ).', ' Electronics & Android'),
(18, 'ARCJET', 'Arcjet engine is an electric jet . It use electric arcs to heat up the air just like fuel is used to heat up the air.\r\nIt use a Tesla turbine working in reverse as a pump to pump the air from the inlet .High potential is applied (between the point and the casing ) to initiate the arc, followed by low voltage high current .The current flows from the point to the rim of the rotor , through the air gap as the arc to to the casing .The current causes the rotor to rotate anti clockwise . This draws in the air expels it radially through the exhaust', ' Electronics & Android'),
(19, 'Android application – Asssiting farmers while purchasing a tractor', 'The project aims at devoliping a simple user friendly application that can guide farmers in selecting a tractor during purchasal, based on their usage. It will not only solve one of the biggest dilemma for farmers, but also serve as a means for Tractor Companies to promote the unique features of their product', ' Electronics & Android'),
(20, 'Browse internet on mobile/tab using lan cable', 'To make a connector that allows usage of internet on mobile phones or tabs through the regular lan ports', ' Electronics & Android'),
(21, 'Mobile charger', 'The idea is to use a small fan while travelling in a train, bus or motor bike – that can convert the wind energy into electrical energy, which can be used to charge a mobile phone', ' Electronics & Android'),
(22, 'Force amplifying gloves', 'This project aims at making a skelital structure over hands, that can be used to reduce human efforts while holding/pressing an object or to increase the maximum force one can apply. Hydraulic/pneumatic structures, that can exert force at different points on fingers can be used to make it. It will be of great help to differently abled people and anyone suffering from injuries ', ' Electronics & Android'),
(23, 'Decreasing strength at toll gates and regarding vehicle passes in insti', 'Image capturing of number plates of cars and buses to reduce manaul effort and save time', 'Image Processing'),
(26, 'AUV: Autonomus surface boat', 'The project is aimed to develop a boat that can navigate autonomously through water bodies on the water surface. This boat possesses various applications which include oceanographic data gathering along with surveillance and fishery monitoring. These can be achieved with the help of application specific oceanographic sensors.', 'Projects from CFI'),
(27, 'AUV: ROS controlled boat', 'The task is to build a simple robot which is being controlled using ROS. ROS will act as the operating system for the robot. It will provide control for the articulated robot and sensors by manipulating its motion as per the feedback received from the on-board sensors.', 'Projects from CFI'),
(28, 'AUV: Single Hull Hydrodynamic Design for AUV', 'The projects is aimed to design a modular, hydrodynamic, single hull prototype for AUV which is highly manoeuvrable and capable of withstanding the pressure of up to 20-30 meters. The design should have the following features: Hydro-dynamically stable\r\nHighly manoeuvrable\r\nLeast minimum drag\r\nSpacious and watertight to enclose electronics', 'Projects from CFI'),
(29, 'Auto Club: Custom Gearbox', 'To design a low cost custom gearbox, ie, a gearbox with custom gear ratios, different than the standard one', 'Projects from CFI'),
(30, 'Auto Club: Fabrication of gearbox', 'The aim of the project is to review different types of existing superchargers (a supercharger is basically a device which enhances power output and torque of the engine at the expense of compression of air) and to come up with a possibly new design of a supercharger. The current bunch of superchargers cost around ?6-10 lakhs. The ultimate outcome is to fabricate a supercharger which should provide notable difference in power output and be cost effective', 'Projects from CFI'),
(31, 'Auto Club: Fabrication of Brake disc', 'The need of the project is to – make an affordable disc\r\n– overcome/minimize heating problems\r\n– make it compact', 'Projects from CFI'),
(32, 'Auto Club: Fabrication of race car aerodynamics kit', 'Develop an aerodynamic kit including front and rear wings for a race car prototype to provide additional necessary downforce and increase the stability and cornering speed. The purpose is to study its aerodynamics in detail and do wind tunnel testing to find out the effect of the wings, and their size and shape', 'Projects from CFI'),
(33, 'Auto Club: Fabriction of tilt steering mechanism- bike', 'This project is aimed at studying the advantages of tilt vehicles over the conventional ones, and to make a fully functional and economically viable, tilted tri-cycle', 'Projects from CFI'),
(34, 'Auto Club: Wireless data acquisition system', 'To collect data of -\r\n? Vehicle Velocity\r\n? RPM of wheels\r\n? Steering Angle\r\n? Yaw-Rate\r\n? Lateral Velocity\r\n? Throttle Position\r\n? Acceleration\r\n? Radius of curvature.\r\nAnd transmitting them wirelessly to a base station. This will in turn help in estimating the performance of the vehicle on which it is mounted', 'Projects from CFI'),
(35, 'Auto Club: Four wheel steering system', 'This project aims to test the functioning of Four Wheel Steering or Quadra Steering System in an electric RC Car. It will first be incorporated in the radio-control car by customizing and re- building an ordinary one.', 'Projects from CFI'),
(36, 'Auto Club: Digital fule indicator and overcoming the limitation of sloshing', 'To make a digital fuel level indicator which displays existing fuel level more accurately than existing analog indicators present in most of vehicles.', 'Projects from CFI'),
(37, 'Auto Club: Manufacture of light weight drive shaft', '(1)To analyse Rzeppa type and tripod type cv joints made of different materials like aluminium, , E-Glass/Epoxy and High modulus (HM) Carbon/Epoxy composites. (2)Then manufacture the best result yielding type of joint and material.\r\n(3)Make a half shaft (axle) both solid and hollow using carbon fibre .\r\n(4)Join the half shaft together with the cv joints and connect to the differential.', 'Projects from CFI'),
(38, 'Auto Club: Fabrication of race car seat', 'This project is aimed at designing and manufacturing of race car seat and steering wheel.', 'Projects from CFI'),
(39, 'Aero Club: Want to fly', 'Learning of RC plane flying, with the help of RC plane flying expert', 'Projects from CFI'),
(40, 'Auto Club: Thermal mapping of tire', 'Project involves thermal mapping of tires, axially.', 'Projects from CFI'),
(41, 'Aero Club: Autonomous Air Plane', 'An Airplane which can do completely autonomous missions using GPS and IMU.', 'Projects from CFI'),
(42, ' Aero Club: Radio controlled Blimps', 'Baloon with actuators for navigation', 'Projects from CFI'),
(43, 'Animtaion Club: Short film', 'We already have a story and, last year, we modelled some of the charcters required.', 'Projects from CFI'),
(44, 'Webops Club: HireFellas', 'A website for an startup by a group of final years in Insti', 'Projects from CFI'),
(45, 'Webops Club: Odia-Community', 'A website for Pan-IIT Odia Community w/ discussion forum, FB integration, mail system and Events & Updates', 'Projects from CFI'),
(46, 'Webops Club: CFI Portal', 'Project Management Portal & Materials Inventory w/ search', 'Projects from CFI'),
(47, 'Webops Club: NuSkin', 'A CMS based website for NuSkin products in India', 'Projects from CFI'),
(48, 'CFI Cycle', '1. CHAINLESS CYCLE : Developing a system which will efficiently convert pedalling power into the translational power of bicycle.\r\n2. MOBILE CHARGING : To develop a convenient method to charge your mobile while pedaling your bicycle\r\n3. SPOKELESS BICYCLE : The idea is to develop alternatives to spoke wheels which provide better suspension.\r\n4.Automatic cycle lock-a device which can be fitted to the cycle lock which automatically locks the cycle when it detects no motion and has detects no weight on the seat. This would help reduce cycle thefts.\r\n5.Cycle Finder-App on a smartphone such that it gives the distance between our cycle\r\nand us and also the directions to where it is parked. This can be done by creating a tracker', ' Robotics & Automotive'),
(49, 'SIngle wheel autonomous self balancing skateboard', 'To build a single wheeled self balancing skateboard', ' Robotics & Automotive'),
(50, 'Learn Swimming Assisted Device (LSAD)', 'A device strapped on to the knees while swimming. If the knees bend more than desired angle, the user is made aware of the same with a vibration.Furthermore, if the user is incapable of correcting himself,the device will exert a force to correct the same and wait till the leg orientation is feeded into the muscle memory ', ' Robotics & Automotive'),
(51, 'I- Glide. Personal Transporter.', '*We are making a personal transporter as a part of Product Development Lab in Engineering Design department.\r\n*We are very keen on taking it a step further and make presentable prototype.\r\n*We have already done literature survey and have a good idea about how to proceed.\r\n\r\nOur Idea is as follows:\r\n-A self balancing 2 wheeled transporter (Target is to make the final prototype single wheeled.)\r\n-Focusing on basic control algorithm for safe propulsion\r\n-Compactness and portability to some extent._\r\n-Design can be extended further to include variants of the same to meet different market needs and safety requirements.', ' Robotics & Automotive'),
(52, 'Robotouch', 'To detect the taste and smell using a robot . Make food tester based on ph ', ' Robotics & Automotive'),
(53, 'Ensuring safety at railway crossing', 'To eliminate injury or casualty of people while crossing the railway tracks, to keep sensors on the railway tracks every 10metres which senses the trains motion and the presence of people in the middle of the track and gives SOUNDS AN ALARM', 'Socially Relevant Projects'),
(54, 'Gas level indicator for cylinders', 'Development of a device to prevent leakage and bursting of gas(LPG) cylinders. Indicate that there is a leakage and stop the leakage of gas(lpg) ', 'Socially Relevant Projects'),
(55, 'Energy saving and optimization in street lights', 'We spend a huge amount of our power in lighting up our streets so as to keep it illuminated and keep us secured, We are going to solve this problem with sensors, energy efficient light systems and and psychological means to improve the mood of the people', 'Socially Relevant Projects'),
(56, 'A WALKING AID', 'Helps the old and disabled to getup from the bed / low level seating , by adjusting its height automatically due to pressure changes, with anti skid provisions / locks .', 'Socially Relevant Projects'),
(57, 'Improved tracking device for fishermen', 'we could build a local network based tracking system for fisherman to ensure that they are in limits of their country. ', 'Socially Relevant Projects'),
(58, 'Easy walking for blind people', 'Generally hc-sr04 sensors are used to detect the distasnce of the obstacle from it. These can be used to navigate the blind people comfortably', 'Socially Relevant Projects'),
(59, 'Device to prevent wastage of food using a device to control humidity in storehouses in rural regions ( food grains store houses)', 'The idea is to create a device which measures and maintain moisture content in the air and can check for fungi or viruses in the air and remotely warn the authorities. ', 'Socially Relevant Projects'),
(60, 'preventing fires in railway compartment', 'A fire sensor which could be set up in each compartment so if suddenly any compartment catches fire, there is a quick signal to the engine to the nearest station.This could help reduce casualties&deaths.', 'Socially Relevant Projects'),
(61, 'Pollution Control device', 'To make a device which can be fitted to exhaust of vehicles to filter the gases passing through it ', 'Socially Relevant Projects'),
(62, 'PAGE TURNING MACHINE-for differently abled people.', 'I have a childhood friend who is quite close to me and unfortunately he lost both of his arms in a train accident some 8 years back however his passion to study and gain knowledge have been the same but he finds turning the pages of books quite cumbersome although he manages to do that with his toe of foot. Now I got the opportunity so I was thinking to make page turning device by incorporating the mechanism of note counting machine used in banks . I think it would be a great help to everyone having this problem. ', 'Socially Relevant Projects'),
(63, 'Reducing human effort on cutting coconut from coconut trees', 'Idea is to build a a coconut climber uUsing wall climbing balls as the legs of a robot (mainly 2 balls with magnetic surface to increase the hold on tree ) and give the robot some flap (light weight -kind of thick sheet) like hands such that it will flap them when it reaches the top. ', 'Socially Relevant Projects'),
(64, 'Vertical farming and plant monitoring for urban farming', 'The problem with urban areas is the lack of availability of space for cultivation. So vertical farming has become one of the innovative solutions to the problem. eg: The vertical garden of OHare airport. Besides this, urban people have very little time to take care of plants and do timely watering , providing soil with sufficient minerals & vitamins etc.. For this reason, we have an idea to build & employ an automatic watering, plant & soil monitoring system for vertical farms using moisture sensors, arduino micro-processor, and actuators. If additional nutrients or water refill is required, it will send an SMS to the mobile phone for the same.\r\nMotivation: Build a self-maintaining vertical farm in IIT-M', 'Socially Relevant Projects');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
