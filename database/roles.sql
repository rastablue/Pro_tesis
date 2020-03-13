/*
SQLyog Enterprise - MySQL GUI v8.12 
MySQL - 5.7.24 : Database - roles
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`roles` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `roles`;

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cedula` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_pater` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_mater` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direc` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tlf` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cedula` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `clientes` */

insert  into `clientes`(`id`,`cedula`,`name`,`apellido_pater`,`apellido_mater`,`direc`,`tlf`,`email`,`created_at`,`updated_at`) values (1,'1206855593','Martin','Ronquillo','Vargas','Pedro Carbo','2735416','marticarcel@hotmail.com',NULL,'2020-03-12 15:08:25'),(2,'1206855594','Julio','Gomez','Otero','ecu 911','2735417','julio@gmail.com',NULL,NULL),(3,'1206855595','Genesis','Intriago','Intriago','ventanas','2735418','genesis@gmail.com',NULL,NULL),(11,'1206855596','Ximena','Cedeño','Casquete','La pj','2735419','ximena@gmail.com','2020-02-21 19:52:50','2020-02-21 19:52:50'),(12,'1206855597','Arturo','De La Ese','Salazar','Duran','2735420','arturo@gmail.com','2020-03-12 13:29:24','2020-03-12 13:29:24'),(14,'1206855598','Mercedes','Castro','Guayllaguaman','IEES','2735421','meche@gmail.com','2020-03-12 15:45:07','2020-03-12 15:45:07');

/*Table structure for table `empleados` */

DROP TABLE IF EXISTS `empleados`;

CREATE TABLE `empleados` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `estado` enum('Activo','Inactivo') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `FK_empleados_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `empleados` */

insert  into `empleados`(`id`,`user_id`,`estado`,`created_at`,`updated_at`) values (3,4,'Activo',NULL,NULL),(4,9,'Activo','2020-02-14 10:34:42','2020-02-14 10:34:42'),(5,11,'Activo','2020-02-14 10:38:13','2020-02-14 10:38:13'),(6,23,'Activo',NULL,NULL),(7,24,'Activo','2020-02-16 15:29:06','2020-02-16 15:29:06');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `mantenimientos` */

DROP TABLE IF EXISTS `mantenimientos`;

CREATE TABLE `mantenimientos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nro_ficha` bigint(7) NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `fecha_egreso` datetime DEFAULT NULL,
  `observacion` text COLLATE utf8mb4_unicode_ci,
  `estado` enum('Activo','Inactivo','En espera','Finalizado') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diagnostico` text COLLATE utf8mb4_unicode_ci,
  `valor_total` float(8,2) DEFAULT NULL,
  `path` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehiculo_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nro_ficha` (`nro_ficha`),
  KEY `FK_mantenimientos_vehiculos` (`vehiculo_id`),
  CONSTRAINT `FK_mantenimientos_vehiculos` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mantenimientos` */

insert  into `mantenimientos`(`id`,`nro_ficha`,`fecha_ingreso`,`fecha_egreso`,`observacion`,`estado`,`diagnostico`,`valor_total`,`path`,`vehiculo_id`,`created_at`,`updated_at`) values (9,2145879,'2020-02-19 10:23:56','2020-03-09 13:22:08','Ninguna 1','Finalizado','Ninguno 1',2000.00,'public/lEW4e9Xf5RBaI9oXDJwoDTtoJwbUJOQxEK8OWBkx.png',5,'2020-02-13 17:23:32','2020-03-09 13:22:08'),(10,2546859,'2020-02-18 17:10:27','2020-03-11 15:02:05','nada bro','Finalizado','nada bro',291.02,'public/rkWugr3e4cqyO35UpO5enfWyKfL9ulog3uXQ2Ezk.png',2,'2020-02-18 17:10:27','2020-03-11 15:02:06'),(11,2548632,'2020-02-20 14:28:32',NULL,'ninguna 3','Activo','ninguno 3',29.01,'public/hpt0k8bBN97NC2Lh0Fyzlak6tS5aDD9SvjKWfIK9.png',2,'2020-02-20 14:28:32','2020-03-09 13:25:53'),(18,3652145,'2020-02-26 16:53:09',NULL,'dsg','Activo','sdff',18.32,'public/kG6jGvgKdVrYQ6bjQjNxUX54UYwQEFYbgd2xT2ls.jpeg',5,'2020-02-26 16:53:09','2020-02-26 17:06:35'),(19,2145878,'2020-03-11 13:20:30',NULL,'pruebaaa','Activo','asdasd',NULL,NULL,13,'2020-03-11 13:20:30','2020-03-12 22:45:03');

/*Table structure for table `marca_vehiculos` */

DROP TABLE IF EXISTS `marca_vehiculos`;

CREATE TABLE `marca_vehiculos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `marca` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `marca_vehiculos` */

insert  into `marca_vehiculos`(`id`,`marca`,`created_at`,`updated_at`) values (1,'Toyota','2020-02-19 11:28:46','2020-02-19 11:28:46'),(2,'Chevrolet','2020-02-19 11:31:22','2020-02-19 11:31:22'),(3,'Jeep','2020-02-19 11:31:39','2020-02-19 11:31:39'),(4,'Mercedes','2020-02-19 11:31:47','2020-02-19 11:31:47'),(5,'Nissan','2020-02-19 11:31:54','2020-02-19 11:31:54'),(6,'Suzuki','2020-02-19 11:32:04','2020-02-19 11:32:04'),(7,'Fiat','2020-02-19 11:32:21','2020-02-19 11:32:21'),(8,'Ford','2020-02-19 11:32:28','2020-02-19 11:32:28'),(9,'Mazda','2020-02-19 11:33:17','2020-02-19 12:24:18'),(10,'Chery','2020-02-19 11:34:24','2020-02-19 11:34:24'),(11,'Audi','2020-02-19 11:34:47','2020-02-19 11:34:47'),(12,'China Motors','2020-02-19 11:35:11','2020-02-19 11:35:11'),(13,'Citroën','2020-02-19 11:35:35','2020-02-19 11:35:35'),(14,'Daewoo','2020-02-19 11:36:06','2020-02-19 11:36:06'),(15,'Peugeot','2020-02-19 11:36:44','2020-02-19 11:36:44'),(16,'BMW','2020-02-19 11:37:16','2020-02-19 11:37:16'),(17,'Sin marca',NULL,NULL);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2015_01_20_084450_create_roles_table',1),(4,'2015_01_20_084525_create_role_user_table',1),(5,'2015_01_24_080208_create_permissions_table',1),(6,'2015_01_24_080433_create_permission_role_table',1),(7,'2015_12_04_003040_add_special_role_column',1),(8,'2017_10_17_170735_create_permission_user_table',1),(9,'2019_08_19_000000_create_failed_jobs_table',1),(10,'2020_02_09_014357_create_clientes_table',1),(11,'2020_02_09_014428_create_empleados_table',1),(12,'2020_02_09_015502_create_vehiculos_table',1),(13,'2020_02_09_020133_create_mantenimientos_table',1),(14,'2020_02_09_020620_create_trabajos_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

insert  into `password_resets`(`email`,`token`,`created_at`) values ('marticarcel@hotmail.com','$2y$10$V5IGVfSbvw84mtrvyWePduB7xrgUTCEigmCkPkdOz7zen/k6RLADG','2020-02-20 16:15:54');

/*Table structure for table `permission_role` */

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permission_role` */

insert  into `permission_role`(`id`,`permission_id`,`role_id`,`created_at`,`updated_at`) values (1,1,2,'2020-02-13 14:29:29','2020-02-13 14:29:29'),(2,2,2,'2020-02-13 14:29:29','2020-02-13 14:29:29'),(3,5,2,'2020-02-13 14:29:29','2020-02-13 14:29:29'),(4,7,2,'2020-02-13 14:29:29','2020-02-13 14:29:29'),(5,8,2,'2020-02-13 14:29:29','2020-02-13 14:29:29'),(6,11,2,'2020-02-13 14:29:30','2020-02-13 14:29:30'),(7,13,2,'2020-02-13 14:29:30','2020-02-13 14:29:30'),(8,14,2,'2020-02-13 14:29:30','2020-02-13 14:29:30'),(9,17,2,'2020-02-13 14:29:30','2020-02-13 14:29:30'),(10,19,2,'2020-02-13 14:29:30','2020-02-13 14:29:30'),(11,20,2,'2020-02-13 14:29:30','2020-02-13 14:29:30'),(12,23,2,'2020-02-13 14:29:30','2020-02-13 14:29:30'),(13,25,2,'2020-02-13 14:29:30','2020-02-13 14:29:30'),(14,26,2,'2020-02-13 14:29:30','2020-02-13 14:29:30'),(15,29,2,'2020-02-13 14:29:30','2020-02-13 14:29:30'),(16,31,2,'2020-02-13 14:29:30','2020-02-13 14:29:30'),(17,32,2,'2020-02-13 14:29:30','2020-02-13 14:29:30'),(18,35,2,'2020-02-13 14:29:30','2020-02-13 14:29:30'),(19,37,2,'2020-02-13 14:29:30','2020-02-13 14:29:30'),(21,41,2,'2020-02-13 14:29:30','2020-02-13 14:29:30'),(22,2,3,'2020-02-13 18:33:06','2020-02-13 18:33:06'),(23,8,3,'2020-02-13 18:33:06','2020-02-13 18:33:06'),(24,26,3,'2020-02-13 18:33:06','2020-02-13 18:33:06'),(25,32,3,'2020-02-13 18:33:06','2020-02-13 18:33:06'),(26,38,3,'2020-02-13 18:33:06','2020-02-13 18:33:06'),(31,7,4,'2020-02-13 23:04:19','2020-02-13 23:04:19'),(32,8,4,'2020-02-13 23:04:19','2020-02-13 23:04:19'),(33,9,4,'2020-02-13 23:04:19','2020-02-13 23:04:19'),(34,11,4,'2020-02-13 23:04:19','2020-02-13 23:04:19'),(35,13,4,'2020-02-13 23:04:19','2020-02-13 23:04:19'),(36,14,4,'2020-02-13 23:04:19','2020-02-13 23:04:19'),(37,17,4,'2020-02-13 23:04:19','2020-02-13 23:04:19'),(41,25,4,'2020-02-13 23:04:19','2020-02-13 23:04:19'),(42,26,4,'2020-02-13 23:04:19','2020-02-13 23:04:19'),(43,28,4,'2020-02-13 23:04:19','2020-02-13 23:04:19'),(44,29,4,'2020-02-13 23:04:20','2020-02-13 23:04:20'),(45,31,4,'2020-02-13 23:04:20','2020-02-13 23:04:20'),(46,32,4,'2020-02-13 23:04:20','2020-02-13 23:04:20'),(47,33,4,'2020-02-13 23:04:20','2020-02-13 23:04:20'),(48,34,4,'2020-02-13 23:04:20','2020-02-13 23:04:20'),(49,35,4,'2020-02-13 23:04:20','2020-02-13 23:04:20'),(51,38,4,'2020-02-13 23:04:20','2020-02-13 23:04:20'),(52,39,4,'2020-02-13 23:04:20','2020-02-13 23:04:20'),(53,40,4,'2020-02-13 23:04:20','2020-02-13 23:04:20'),(54,41,4,'2020-02-13 23:04:20','2020-02-13 23:04:20'),(55,27,4,NULL,NULL),(56,44,2,'2020-02-19 12:31:29','2020-02-19 12:31:29'),(57,45,2,'2020-02-19 12:31:29','2020-02-19 12:31:29'),(58,48,2,'2020-02-19 12:31:30','2020-02-19 12:31:30'),(59,50,2,'2020-02-26 23:16:03','2020-02-26 23:16:03'),(60,50,4,'2020-02-26 23:16:11','2020-02-26 23:16:11'),(61,1,5,'2020-03-06 12:57:17','2020-03-06 12:57:17'),(62,5,5,'2020-03-06 12:57:17','2020-03-06 12:57:17'),(63,1,6,'2020-03-09 17:28:33','2020-03-09 17:28:33'),(64,2,6,'2020-03-09 17:28:33','2020-03-09 17:28:33'),(65,4,6,'2020-03-09 17:28:33','2020-03-09 17:28:33'),(66,5,6,'2020-03-09 17:28:33','2020-03-09 17:28:33'),(67,7,6,'2020-03-09 17:28:33','2020-03-09 17:28:33'),(68,8,6,'2020-03-09 17:28:33','2020-03-09 17:28:33'),(69,10,6,'2020-03-09 17:28:33','2020-03-09 17:28:33'),(70,11,6,'2020-03-09 17:28:33','2020-03-09 17:28:33'),(71,13,6,'2020-03-09 17:28:33','2020-03-09 17:28:33'),(72,14,6,'2020-03-09 17:28:33','2020-03-09 17:28:33'),(73,16,6,'2020-03-09 17:28:33','2020-03-09 17:28:33'),(74,17,6,'2020-03-09 17:28:33','2020-03-09 17:28:33'),(75,25,6,'2020-03-09 17:28:33','2020-03-09 17:28:33'),(76,26,6,'2020-03-09 17:28:33','2020-03-09 17:28:33'),(77,28,6,'2020-03-09 17:28:33','2020-03-09 17:28:33'),(78,29,6,'2020-03-09 17:28:33','2020-03-09 17:28:33'),(79,37,6,'2020-03-09 17:28:33','2020-03-09 17:28:33'),(80,38,6,'2020-03-09 17:28:34','2020-03-09 17:28:34'),(81,40,6,'2020-03-09 17:28:34','2020-03-09 17:28:34'),(82,41,6,'2020-03-09 17:28:34','2020-03-09 17:28:34'),(83,44,6,'2020-03-09 17:28:34','2020-03-09 17:28:34'),(84,45,6,'2020-03-09 17:28:34','2020-03-09 17:28:34'),(85,48,6,'2020-03-09 17:28:34','2020-03-09 17:28:34'),(86,50,6,'2020-03-09 17:28:34','2020-03-09 17:28:34');

/*Table structure for table `permission_user` */

DROP TABLE IF EXISTS `permission_user`;

CREATE TABLE `permission_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_user_permission_id_index` (`permission_id`),
  KEY `permission_user_user_id_index` (`user_id`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permission_user` */

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`slug`,`description`,`created_at`,`updated_at`) values (1,'Navegar usuarios','users.index','Lista y navega todos los usuarios del sistema','2020-02-11 00:19:42','2020-02-11 00:19:42'),(2,'Ver detalle de usuario','users.show','Ver en detalle cada usuario del sistema','2020-02-11 00:19:42','2020-02-11 00:19:42'),(3,'Creacion de usuarios','users.create','Crea usuarios en el sistema','2020-02-11 00:19:42','2020-02-11 00:19:42'),(4,'Edicion de usuarios','users.edit','Editar cualquier dato de un usuario del sistema','2020-02-11 00:19:42','2020-02-11 00:19:42'),(5,'Consultar usuarios','users.search','Consulta de un usuario especifico del sistema','2020-02-11 00:19:42','2020-02-11 00:19:42'),(6,'Eliminar usuarios','users.destroy','Eliminar cualquier usuario del sistema','2020-02-11 00:19:42','2020-02-11 00:19:42'),(7,'Navegar clientes','clientes.index','Lista y navega todos los clientes del sistema','2020-02-11 00:19:42','2020-02-11 00:19:42'),(8,'Ver detalle de cliente','clientes.show','Ver en detalle cada cliente del sistema','2020-02-11 00:19:42','2020-02-11 00:19:42'),(9,'Creacion de clientes','clientes.create','Crea clientes en el sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(10,'Edicion de clientes','clientes.edit','Editar cualquier dato de un cliente del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(11,'Consultar clientes','clientes.search','Consulta de un cliente especifico del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(12,'Eliminar clientes','clientes.destroy','Eliminar cualquier usuario del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(13,'Navegar empleados','empleados.index','Lista y navega todos los empleados del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(14,'Ver detalle de empleado','empleados.show','Ver en detalle cada empleado del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(15,'Creacion de empleados','empleados.create','Crea empleados en el sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(16,'Edicion de empleados','empleados.edit','Editar cualquier dato de un empleado del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(17,'Consultar empleados','empleados.search','Consulta de un empleado especifico del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(18,'Eliminar empleados','empleados.destroy','Eliminar cualquier empleado del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(19,'Navegar roles','roles.index','Lista y navega todos los roles del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(20,'Ver detalle de rol','roles.show','Ver en detalle cada rol del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(21,'Creacion de roles','roles.create','Crea roles de un usuario del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(22,'Editar roles','roles.edit','Edita roles del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(23,'Consultar roles','roles.search','Consulta de un rol especifico del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(24,'Eliminar roles','roles.destroy','Eliminar rol del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(25,'Navegar vehiculos','vehiculos.index','Lista y navega todos los vehiculos del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(26,'Ver detalle de vehiculo','vehiculos.show','Ver en detalle cada vehiculo del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(27,'Creacion de vehiculos','vehiculos.create','Crea vehiculos en el sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(28,'Editar vehiculos','vehiculos.edit','Edita vehiculos del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(29,'Consultar vehiculos','vehiculos.search','Consulta de un vehiculo especifico del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(30,'Eliminar vehiculos','vehiculos.destroy','Eliminar vehiculos del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(31,'Navegar mantenimientos','mantenimientos.index','Lista y navega todos los mantenimientos del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(32,'Ver detalle de mantenimiento','mantenimientos.show','Ver en detalle cada mantenimiento del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(33,'Creacion de mantenimientos','mantenimientos.create','Crea mantenimientos del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(34,'Editar mantenimientos','mantenimientos.edit','Edita mantenimientos del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(35,'Consultar mantenimientos','mantenimientos.search','Consulta de un mantenimiento especifico del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(36,'Eliminar mantenimientos','mantenimientos.destroy','Eliminar mantenimientos del sistema','2020-02-11 00:19:44','2020-02-11 00:19:44'),(37,'Navegar trabajos','trabajos.index','Lista y navega todos los trabajos del sistema','2020-02-11 00:19:44','2020-02-11 00:19:44'),(38,'Ver detalle de trabajos','trabajos.show','Ver en detalle cada trabajo del sistema','2020-02-11 00:19:44','2020-02-11 00:19:44'),(39,'Creacion de trabajos','trabajos.create','Crea trabajos de un mantenimiento del sistema','2020-02-11 00:19:44','2020-02-11 00:19:44'),(40,'Editar trabajos','trabajos.edit','Edita trabajos del sistema','2020-02-11 00:19:44','2020-02-11 00:19:44'),(41,'Consultar trabajos','trabajos.search','Consulta de un trabajo especifico del sistema','2020-02-11 00:19:44','2020-02-11 00:19:44'),(42,'Eliminar trabajos','trabajos.destroy','Eliminar trabajo del sistema','2020-02-11 00:19:44','2020-02-11 00:19:44'),(43,'Edita claves','claves.admin','Edita las claves identificatorias de los apartados Ej... placa, cedula, etc.',NULL,NULL),(44,'Navegar marcas de vehiculos','marcas.index','Lista y navega todas las marcas de vehiculos',NULL,NULL),(45,'Ver detalle de las marcas','marcas.show','Ver en detalle cada marca del sistema',NULL,NULL),(46,'Creacion de marcas','marcas.create','Crea marcas en el sistema',NULL,NULL),(47,'Editar marcas','marcas.edit','Edita las marcas del sistema',NULL,NULL),(48,'Consultar marcas','marcas.search','Consulta marcas especificas del sistema',NULL,NULL),(49,'Elimina marcas','marcas.destroy','Elimina marcas del sistema',NULL,NULL),(50,'Ver fichas','fichas.show','Ver la ficha escaneada',NULL,NULL),(51,'Agregar ficha','fichas.create','Agrega una ficha en un mantenimiento deseado',NULL,NULL);

/*Table structure for table `role_user` */

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_user` */

insert  into `role_user`(`id`,`role_id`,`user_id`,`created_at`,`updated_at`) values (3,2,22,'2020-02-13 17:35:42','2020-02-13 17:35:42'),(5,4,23,'2020-02-13 23:06:50','2020-02-13 23:06:50'),(7,1,21,NULL,NULL),(19,4,24,'2020-03-06 12:58:14','2020-03-06 12:58:14'),(20,3,25,'2020-03-11 19:35:26','2020-03-11 19:35:26'),(28,3,26,'2020-03-12 19:19:57','2020-03-12 19:19:57');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `special` enum('all-access','no-access') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`slug`,`description`,`created_at`,`updated_at`,`special`) values (1,'Administrador','admin','Administrador principal del sistema','2020-02-11 00:19:45','2020-02-11 00:19:45','all-access'),(2,'Auditor','auditor','Solo puede observar los campos, pero no puede modificarla ni eliminarla','2020-02-13 14:29:29','2020-02-13 14:29:29',NULL),(3,'Cliente','cliente','Solo dispone de su informacion','2020-02-13 18:33:05','2020-02-13 18:33:05',NULL),(4,'Empleado','empleado','Acceso a las funciones importantes para un empleado del sistema','2020-02-13 23:04:19','2020-02-13 23:04:19',NULL),(5,'No vehiculos','sin vehiculos','No puede visualizar vehiculos','2020-03-06 12:57:16','2020-03-12 22:31:47',NULL),(6,'No Mantenimientos','sin mantenimientos','No puede visualizar los mantenimientos','2020-03-09 17:28:33','2020-03-12 22:31:36',NULL);

/*Table structure for table `trabajos` */

DROP TABLE IF EXISTS `trabajos`;

CREATE TABLE `trabajos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `manobra` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `repuestos` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `costo_repuestos` double(8,2) DEFAULT NULL,
  `costo_manobra` double(8,2) NOT NULL,
  `estado` enum('Activo','Inactivo','En espera','Finalizado') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` enum('Preventivo','Correctivo') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mantenimiento_id` bigint(20) unsigned NOT NULL,
  `empleado_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_trabajos_empleados` (`empleado_id`),
  KEY `FK_trabajos_mantenimientos` (`mantenimiento_id`),
  CONSTRAINT `FK_trabajos_empleados` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`),
  CONSTRAINT `FK_trabajos_mantenimientos` FOREIGN KEY (`mantenimiento_id`) REFERENCES `mantenimientos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `trabajos` */

insert  into `trabajos`(`id`,`manobra`,`repuestos`,`costo_repuestos`,`costo_manobra`,`estado`,`tipo`,`mantenimiento_id`,`empleado_id`,`created_at`,`updated_at`) values (29,'nada 2','ninguno 2',1000.00,1000.00,'Activo','Correctivo',9,6,'2020-02-20 12:14:25','2020-02-20 12:14:25'),(31,'nada 3','ninguno 3',30.25,3.33,'Activo','Preventivo',10,7,'2020-02-20 12:15:48','2020-02-20 12:15:48'),(32,'nada 4','ninguno 4',232.30,25.14,'Activo','Correctivo',10,6,'2020-02-20 12:25:46','2020-02-20 12:25:46'),(33,'nada 5','ninguno 5',23.32,5.69,'Activo','Preventivo',11,6,'2020-02-20 15:12:18','2020-02-20 15:12:53'),(34,'nada 6','nada 6',15.20,3.12,'Activo','Preventivo',18,6,'2020-03-12 21:47:20','2020-03-12 21:47:20');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cedula` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_pater` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_mater` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tlf` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `cedula` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`cedula`,`name`,`apellido_pater`,`apellido_mater`,`direc`,`tlf`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values (4,'4','Mark Flatley V','Et dignissimos magni consequatur eligendi aperiam.','Occaecati saepe consequatur hic iure repudiandae voluptatum.','Magni quo repellendus tenetur pariatur.','2536514','jcummings@example.net','2020-02-11 00:19:44','$2y$10$3VmxscV0QbY16XiIkwAcIOEaTZScQGh0RztwT4R4Oxgn7rvOr5.wG','D3MtJk3cbW','2020-02-11 00:19:45','2020-02-13 16:55:59'),(9,'9','Aliyah Glover MD','Dicta sunt quo aliquam at molestiae.','Minima iste dolores dignissimos est.','Libero qui in est nisi.','5','caleigh48@example.org','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','SVnRyEmEzy','2020-02-11 00:19:45','2020-02-11 00:19:45'),(10,'10','Ima Crist Sr.','Voluptas totam beatae maxime.','Accusantium sequi cum quibusdam fugiat maiores.','Et velit aut molestias pariatur ut.','8','toy.verlie@example.org','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','pSX2SsUtLP','2020-02-11 00:19:45','2020-02-11 00:19:45'),(11,'11','Isabel Lynch','Reiciendis quo molestiae suscipit amet magnam.','Voluptas placeat aut ipsa voluptatibus rerum.','Ea necessitatibus autem consectetur incidunt libero voluptas.','9','pmills@example.com','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','LHUQODpEKx','2020-02-11 00:19:45','2020-02-11 00:19:45'),(12,'12','Anais Deckow','Et repellat est odio.','Sunt ad aliquam qui id mollitia pariatur.','Quam quasi at voluptatem.','7','angelo.goldner@example.org','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','sKIyj3fC9f','2020-02-11 00:19:45','2020-02-11 00:19:45'),(15,'15','Vida Von','Velit velit qui est dolorum consequatur.','Voluptatum ea est ratione esse id.','Sit natus temporibus eligendi vel iste.','1','hledner@example.org','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','z3RWjfCyHk','2020-02-11 00:19:45','2020-02-11 00:19:45'),(16,'16','Romaine Schinner','Aperiam quo totam ut velit ut.','Praesentium a repudiandae ab quibusdam.','Molestiae ducimus qui quaerat maiores saepe sint sapiente.','2','hand.shana@example.net','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','aaFaSPKSUO','2020-02-11 00:19:45','2020-02-11 00:19:45'),(17,'17','Adolfo Monahan','Voluptatem facere veniam vitae.','Temporibus laudantium voluptatem aspernatur exercitationem.','Dolore tempora nostrum consequuntur iste ut.','2','delpha.ratke@example.com','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','afevOetpyV','2020-02-11 00:19:45','2020-02-11 00:19:45'),(18,'18','Lea Panocha','Modi molestias quasi consectetur aut.','Quibusdam consequatur rerum iste asperiores quia est quas.','Ut labore ut et quis qui qui ratione minus.','7','bernier.lowell@example.com','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','sV64mvRZaA','2020-02-11 00:19:45','2020-02-11 00:19:45'),(19,'19','Ruby Kuvalis I','Placeat non a non excepturi officiis aut.','Qui aspernatur dolore omnis.','Adipisci fuga ut et neque autem velit minima.','0','ibrakus@example.com','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','p1sey5J2zA','2020-02-11 00:19:45','2020-02-11 00:19:45'),(20,'20','Abigayle Ebert MD','Ab eos et et sequi commodi saepe voluptas.','Autem qui quidem illo commodi nobis suscipit aliquam.','Eius quisquam fugit quae molestias.','4','gblock@example.org','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','xut9jMQx48','2020-02-11 00:19:45','2020-02-11 00:19:45'),(21,'1206855593','Martin','Ronquillo','Vargas','Pedro Carbo y 5 de Junio','2735416','marticarcel@hotmail.com',NULL,'$2y$10$70/KAo19W3nkaHjSvc.OjeB1P531AWPQggn0fHrEpsICJkl3.IDHa',NULL,'2020-02-11 00:36:12','2020-03-12 19:14:19'),(22,'1206855594','Ximena','Cedenio','Casquete','La Pj','2735417','ximena@gmail.com',NULL,'$2y$10$/B2wg.ESIJ8gXi9JAdhprutcEFs/DKUtQvIXOcaoi8sNChVOS6rG6',NULL,'2020-02-12 12:32:00','2020-02-13 17:35:41'),(23,'1206855595','Mariana','Quisirumbay','Armijo','Las Naves','2735418','mariana@gmail.com',NULL,'$2y$10$FGupETDnShP8mzp3uwmZmubPdoOT6N/YNhVXI2HWQcPqnckdOz3ES',NULL,'2020-02-13 18:20:03','2020-03-09 00:08:55'),(24,'1206855596','Jose','Balseca','Armero','Pa deeeeeeentro','2569856324','jose@gmail.com',NULL,'$2y$10$g6xVfm7UgJyVjplUR/Si8OeL/UK7kOF8J/htiFtQ3qGjqBwqVDaoi',NULL,'2020-02-16 15:28:53','2020-02-16 15:28:53'),(25,'1206855560','Julio','Gomez','Otero','bypass','2548754','julio@gmail.com',NULL,'$2y$10$lFKKUkKzwDSGYFzBfxFn1emztb0XYsfSNeu3L8smu4Dk6xyecF6ci',NULL,'2020-02-19 15:42:18','2020-03-11 19:35:26'),(26,'1206855597','Jeremy','Ronquillo','Vasquez','Ricaurte','2735420','jeremy@gmail.com',NULL,'$2y$10$YO3eY4PiTLTq.xQ0aOy4H.gscyvcR2AYhE.WJPI7eeIjaYHtH8lrG',NULL,'2020-02-19 22:33:37','2020-03-12 17:06:00'),(30,'1206855598','Genesis','Intriago','Intriago','ventanas','2735419','genesis@gmail.com',NULL,'$2y$10$UK2dNvNTYUd69lKwy52E6ezVM78Blx45cs6PRitRJp6ctutZoDiZu',NULL,'2020-02-25 11:56:25','2020-02-25 12:37:19'),(31,'1206855599','Arturo','De La Ese','Salazar','Duran','2735421','arturo@gmail.com',NULL,'$2y$10$pyu.HKJuul3dY4x738l/Mu6CEBBPYX4oMxHv.a.TiSwAapz3bFMSi',NULL,'2020-03-08 23:49:29','2020-03-08 23:49:29');

/*Table structure for table `vehiculos` */

DROP TABLE IF EXISTS `vehiculos`;

CREATE TABLE `vehiculos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `placa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marca_vehiculo_id` bigint(20) unsigned NOT NULL,
  `modelo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kilometraje` bigint(20) DEFAULT NULL,
  `observacion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cliente_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `placa` (`placa`),
  KEY `FK_vehiculos_clientes` (`cliente_id`),
  KEY `FK_vehiculos_marcas` (`marca_vehiculo_id`),
  CONSTRAINT `FK_vehiculos_clientes` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  CONSTRAINT `FK_vehiculos_marcas` FOREIGN KEY (`marca_vehiculo_id`) REFERENCES `marca_vehiculos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `vehiculos` */

insert  into `vehiculos`(`id`,`placa`,`marca_vehiculo_id`,`modelo`,`color`,`kilometraje`,`observacion`,`cliente_id`,`created_at`,`updated_at`) values (2,'GSH-524',1,'Fortune','Blanco',300254,'Pequeño rayon',1,NULL,'2020-02-25 11:35:25'),(5,'HSD-265',8,'F-150','Negro',236578,'ventanas portatiles',1,'2020-02-11 19:03:04','2020-03-05 14:27:36'),(10,'HOW20H',4,'Wrangler','Concho vino',54829,'faro lateral roto',2,'2020-02-21 13:31:15','2020-03-05 14:27:49'),(12,'GSH-523',3,'Aveo','Concho vino',NULL,'asd',2,'2020-03-06 22:42:54','2020-03-06 22:42:54'),(13,'CHIEF-001',11,'Ascenssion','Plateado',NULL,'nada',3,'2020-03-07 21:33:58','2020-03-07 21:33:58'),(16,'BTF-333',14,'Crunch','Rose',13653,'Recien pintado',11,'2020-03-08 22:39:09','2020-03-12 16:11:42');

/* Trigger structure for table `clientes` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `delete_vehiculos` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `delete_vehiculos` BEFORE DELETE ON `clientes` FOR EACH ROW BEGIN
    DELETE 
      FROM vehiculos
     WHERE vehiculos.cliente_id = old.id;
END */$$


DELIMITER ;

/* Trigger structure for table `empleados` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `actualizar_empleado_mantenimiento` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `actualizar_empleado_mantenimiento` BEFORE DELETE ON `empleados` FOR EACH ROW BEGIN
	UPDATE trabajos
	SET empleado_id = NULL
	WHERE trabajos.empleado_id = old.id;
END */$$


DELIMITER ;

/* Trigger structure for table `mantenimientos` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `delete_trabajo` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `delete_trabajo` BEFORE DELETE ON `mantenimientos` FOR EACH ROW BEGIN
    DELETE 
      FROM trabajos
     WHERE trabajos.mantenimiento_id = old.id;
END */$$


DELIMITER ;

/* Trigger structure for table `trabajos` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `inserta_val_total` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `inserta_val_total` AFTER INSERT ON `trabajos` FOR EACH ROW BEGIN
        UPDATE mantenimientos 
        SET valor_total = (SELECT SUM(costo_repuestos) 
			   FROM trabajos 
			   WHERE mantenimiento_id = mantenimientos.id) 
			   + 
			  (SELECT SUM(costo_manobra) 
			   FROM trabajos 
			   WHERE mantenimiento_id = mantenimientos.id)
        WHERE id = (SELECT mantenimiento_id FROM trabajos where mantenimiento_id = mantenimientos.id  LIMIT 1);
END */$$


DELIMITER ;

/* Trigger structure for table `trabajos` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `actualiza_val_total` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `actualiza_val_total` AFTER UPDATE ON `trabajos` FOR EACH ROW BEGIN
        UPDATE mantenimientos 
        SET valor_total = (SELECT SUM(costo_repuestos) 
			   FROM trabajos 
			   WHERE mantenimiento_id = mantenimientos.id) 
			   + 
			  (SELECT SUM(costo_manobra) 
			   FROM trabajos 
			   WHERE mantenimiento_id = mantenimientos.id)
        WHERE id = (SELECT mantenimiento_id FROM trabajos where mantenimiento_id = mantenimientos.id  LIMIT 1);
END */$$


DELIMITER ;

/* Trigger structure for table `trabajos` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `refresca_val_total` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `refresca_val_total` AFTER DELETE ON `trabajos` FOR EACH ROW BEGIN
        UPDATE mantenimientos 
        SET valor_total = (SELECT SUM(costo_repuestos) 
			   FROM trabajos 
			   WHERE mantenimiento_id = mantenimientos.id) 
			   + 
			  (SELECT SUM(costo_manobra) 
			   FROM trabajos 
			   WHERE mantenimiento_id = mantenimientos.id)
        WHERE id = (SELECT old.mantenimiento_id FROM trabajos WHERE old.mantenimiento_id = mantenimientos.id  LIMIT 1);
END */$$


DELIMITER ;

/* Trigger structure for table `users` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `delete_empleado` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `delete_empleado` BEFORE DELETE ON `users` FOR EACH ROW BEGIN
    DELETE 
      FROM empleados
     WHERE empleados.user_id = old.id;
END */$$


DELIMITER ;

/* Trigger structure for table `vehiculos` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `delete_mantenimientos` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `delete_mantenimientos` BEFORE DELETE ON `vehiculos` FOR EACH ROW BEGIN
    DELETE 
      FROM mantenimientos
     WHERE mantenimientos.vehiculo_id = old.id;
END */$$


DELIMITER ;

/* Function  structure for function  `val_total` */

/*!50003 DROP FUNCTION IF EXISTS `val_total` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `val_total`(id_mante bigint(20)) RETURNS float
BEGIN
DECLARE result FLOAT(3.2);
SET result = (SELECT sum(costo_repuestos) FROM trabajos WHERE mantenimiento_id = id_mante) + (SELECT sum(costo_manobra) FROM trabajos WHERE mantenimiento_id = id_mante);
RETURN result;
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
