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
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `FK_clientes_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `clientes` */

insert  into `clientes`(`id`,`user_id`,`created_at`,`updated_at`) values (1,21,NULL,NULL);

/*Table structure for table `empleados` */

DROP TABLE IF EXISTS `empleados`;

CREATE TABLE `empleados` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `FK_empleados_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `empleados` */

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
  `observacion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` enum('Activo','Inactivo','En espera','Finalizado') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` enum('Preventivo','Correctivo') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diagnostico` text COLLATE utf8mb4_unicode_ci,
  `vehiculo_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nro_ficha` (`nro_ficha`),
  KEY `FK_mantenimientos_vehiculos` (`vehiculo_id`),
  CONSTRAINT `FK_mantenimientos_vehiculos` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mantenimientos` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permission_role` */

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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`slug`,`description`,`created_at`,`updated_at`) values (1,'Navegar usuarios','users.index','Lista y navega todos los usuarios del sistema','2020-02-11 00:19:42','2020-02-11 00:19:42'),(2,'Ver detalle de usuario','users.show','Ver en detalle cada usuario del sistema','2020-02-11 00:19:42','2020-02-11 00:19:42'),(3,'Creacion de usuarios','users.create','Crea usuarios en el sistema','2020-02-11 00:19:42','2020-02-11 00:19:42'),(4,'Edicion de usuarios','users.edit','Editar cualquier dato de un usuario del sistema','2020-02-11 00:19:42','2020-02-11 00:19:42'),(5,'Consultar usuarios','users.search','Consulta de un usuario especifico del sistema','2020-02-11 00:19:42','2020-02-11 00:19:42'),(6,'Eliminar usuarios','users.destroy','Eliminar cualquier usuario del sistema','2020-02-11 00:19:42','2020-02-11 00:19:42'),(7,'Navegar clientes','clientes.index','Lista y navega todos los clientes del sistema','2020-02-11 00:19:42','2020-02-11 00:19:42'),(8,'Ver detalle de cliente','clientes.show','Ver en detalle cada cliente del sistema','2020-02-11 00:19:42','2020-02-11 00:19:42'),(9,'Creacion de clientes','clientes.create','Crea clientes en el sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(10,'Edicion de clientes','clientes.edit','Editar cualquier dato de un cliente del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(11,'Consultar clientes','clientes.search','Consulta de un cliente especifico del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(12,'Eliminar clientes','clientes.destroy','Eliminar cualquier usuario del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(13,'Navegar empleados','empleados.index','Lista y navega todos los empleados del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(14,'Ver detalle de empleado','empleados.show','Ver en detalle cada empleado del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(15,'Creacion de empleados','empleados.create','Crea empleados en el sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(16,'Edicion de empleados','empleados.edit','Editar cualquier dato de un empleado del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(17,'Consultar empleados','empleados.search','Consulta de un empleado especifico del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(18,'Eliminar empleados','empleados.destroy','Eliminar cualquier empleado del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(19,'Navegar roles','roles.index','Lista y navega todos los roles del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(20,'Ver detalle de rol','roles.show','Ver en detalle cada rol del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(21,'Creacion de roles','roles.create','Crea roles de un usuario del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(22,'Editar roles','roles.edit','Edita roles del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(23,'Consultar roles','roles.search','Consulta de un rol especifico del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(24,'Eliminar roles','roles.destroy','Eliminar rol del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(25,'Navegar vehiculos','vehiculos.index','Lista y navega todos los vehiculos del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(26,'Ver detalle de vehiculo','vehiculos.show','Ver en detalle cada vehiculo del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(27,'Creacion de vehiculos','vehiculos.create','Crea vehiculos en el sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(28,'Editar vehiculos','vehiculos.edit','Edita vehiculos del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(29,'Consultar vehiculos','vehiculos.search','Consulta de un vehiculo especifico del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(30,'Eliminar vehiculos','vehiculos.destroy','Eliminar vehiculos del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(31,'Navegar mantenimientos','mantenimientos.index','Lista y navega todos los mantenimientos del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(32,'Ver detalle de mantenimiento','mantenimientos.show','Ver en detalle cada mantenimiento del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(33,'Creacion de mantenimientos','mantenimientos.create','Crea mantenimientos del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(34,'Editar mantenimientos','mantenimientos.edit','Edita mantenimientos del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(35,'Consultar mantenimientos','mantenimientos.search','Consulta de un mantenimiento especifico del sistema','2020-02-11 00:19:43','2020-02-11 00:19:43'),(36,'Eliminar mantenimientos','mantenimientos.destroy','Eliminar mantenimientos del sistema','2020-02-11 00:19:44','2020-02-11 00:19:44'),(37,'Navegar trabajos','trabajos.index','Lista y navega todos los trabajos del sistema','2020-02-11 00:19:44','2020-02-11 00:19:44'),(38,'Ver detalle de trabajos','trabajos.show','Ver en detalle cada trabajo del sistema','2020-02-11 00:19:44','2020-02-11 00:19:44'),(39,'Creacion de trabajos','trabajos.create','Crea trabajos de un mantenimiento del sistema','2020-02-11 00:19:44','2020-02-11 00:19:44'),(40,'Editar trabajos','trabajos.edit','Edita trabajos del sistema','2020-02-11 00:19:44','2020-02-11 00:19:44'),(41,'Consultar trabajos','trabajos.search','Consulta de un trabajo especifico del sistema','2020-02-11 00:19:44','2020-02-11 00:19:44'),(42,'Eliminar trabajos','trabajos.destroy','Eliminar trabajo del sistema','2020-02-11 00:19:44','2020-02-11 00:19:44');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_user` */

insert  into `role_user`(`id`,`role_id`,`user_id`,`created_at`,`updated_at`) values (1,1,21,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`slug`,`description`,`created_at`,`updated_at`,`special`) values (1,'Administrador','admin','Administrador principal del sistema','2020-02-11 00:19:45','2020-02-11 00:19:45','all-access');

/*Table structure for table `trabajos` */

DROP TABLE IF EXISTS `trabajos`;

CREATE TABLE `trabajos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `manobra` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `repuestos` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `costo_repuestos` double(8,2) DEFAULT NULL,
  `costo_manobra` double(8,2) NOT NULL,
  `estado` enum('Activo','Inactivo','En espera','Finalizado') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mantenimiento_id` bigint(20) unsigned NOT NULL,
  `empleado_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_trabajos_empleados` (`empleado_id`),
  KEY `FK_trabajos_mantenimientos` (`mantenimiento_id`),
  CONSTRAINT `FK_trabajos_empleados` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id`),
  CONSTRAINT `FK_trabajos_mantenimientos` FOREIGN KEY (`mantenimiento_id`) REFERENCES `mantenimientos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `trabajos` */

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`cedula`,`name`,`apellido_pater`,`apellido_mater`,`direc`,`tlf`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values (1,'1','Herta Shields','Autem in ex expedita explicabo aut et aliquam sit.','Quia voluptas ratione et ab neque asperiores et.','Autem sunt minima aut animi.','9','odonnelly@example.org','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','N1Y8W1xlUR','2020-02-11 00:19:44','2020-02-11 00:19:44'),(2,'2','Brenna Bergstrom','Quaerat in ipsum qui nemo eligendi laudantium.','Dolorem aut inventore commodi optio et.','Ullam mollitia laudantium et quo.','7','eldon.russel@example.org','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','hzweR3HFmM','2020-02-11 00:19:44','2020-02-11 00:19:44'),(3,'3','Miss Sierra Schulist','Nam enim hic nobis et error delectus fuga.','Ullam molestiae accusantium ratione.','Ut ut necessitatibus modi aut.','3','morissette.weldon@example.org','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','VesI0AlDPk','2020-02-11 00:19:45','2020-02-11 00:19:45'),(4,'4','Mark Flatley V','Et dignissimos magni consequatur eligendi aperiam.','Occaecati saepe consequatur hic iure repudiandae voluptatum.','Magni quo repellendus tenetur pariatur.','1','jcummings@example.net','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','D3MtJk3cbW','2020-02-11 00:19:45','2020-02-11 00:19:45'),(5,'5','Elda Mraz','Officiis omnis repudiandae eos pariatur recusandae asperiores.','Voluptas deleniti quis amet doloremque amet.','Dolorem est quam dolores et.','1','powlowski.darrick@example.com','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','25oPh4oy4h','2020-02-11 00:19:45','2020-02-11 00:19:45'),(6,'6','Lue Keebler','Animi numquam voluptate voluptatem dolorem aut reiciendis.','Quis praesentium sit optio illum sint et.','Aut magnam nam aliquam.','7','lhirthe@example.net','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','jUMsh4E3yr','2020-02-11 00:19:45','2020-02-11 00:19:45'),(7,'7','Mittie Jaskolski','Enim sit ut illo quam.','Nisi modi id impedit earum labore assumenda laborum.','Et nobis maxime praesentium est non et consequatur.','4','nkuvalis@example.com','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','9BALLpAra5','2020-02-11 00:19:45','2020-02-11 00:19:45'),(8,'8','Keon Huel','Est explicabo modi laborum sit at voluptas.','Neque sunt consequatur excepturi vel quo harum.','Est omnis et minima aut.','1','emmet16@example.com','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','4CTyGvYfty','2020-02-11 00:19:45','2020-02-11 00:19:45'),(9,'9','Aliyah Glover MD','Dicta sunt quo aliquam at molestiae.','Minima iste dolores dignissimos est.','Libero qui in est nisi.','5','caleigh48@example.org','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','SVnRyEmEzy','2020-02-11 00:19:45','2020-02-11 00:19:45'),(10,'10','Ima Crist Sr.','Voluptas totam beatae maxime.','Accusantium sequi cum quibusdam fugiat maiores.','Et velit aut molestias pariatur ut.','8','toy.verlie@example.org','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','pSX2SsUtLP','2020-02-11 00:19:45','2020-02-11 00:19:45'),(11,'11','Isabel Lynch','Reiciendis quo molestiae suscipit amet magnam.','Voluptas placeat aut ipsa voluptatibus rerum.','Ea necessitatibus autem consectetur incidunt libero voluptas.','9','pmills@example.com','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','LHUQODpEKx','2020-02-11 00:19:45','2020-02-11 00:19:45'),(12,'12','Anais Deckow','Et repellat est odio.','Sunt ad aliquam qui id mollitia pariatur.','Quam quasi at voluptatem.','7','angelo.goldner@example.org','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','sKIyj3fC9f','2020-02-11 00:19:45','2020-02-11 00:19:45'),(13,'13','Everett McGlynn','Sint quis eos doloremque consequuntur temporibus necessitatibus temporibus.','Quia recusandae sint repellendus.','Est et cupiditate necessitatibus similique animi voluptate.','4','adan44@example.org','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','UUHeKFcYtO','2020-02-11 00:19:45','2020-02-11 00:19:45'),(14,'14','Ole Gutmann III','Dolores exercitationem nostrum et explicabo quia atque doloremque.','Sit inventore maxime dolorem minima.','Qui eos consequatur facilis qui.','4','tlesch@example.com','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','WFaGdLl2N8','2020-02-11 00:19:45','2020-02-11 00:19:45'),(15,'15','Vida Von','Velit velit qui est dolorum consequatur.','Voluptatum ea est ratione esse id.','Sit natus temporibus eligendi vel iste.','1','hledner@example.org','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','z3RWjfCyHk','2020-02-11 00:19:45','2020-02-11 00:19:45'),(16,'16','Romaine Schinner','Aperiam quo totam ut velit ut.','Praesentium a repudiandae ab quibusdam.','Molestiae ducimus qui quaerat maiores saepe sint sapiente.','2','hand.shana@example.net','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','aaFaSPKSUO','2020-02-11 00:19:45','2020-02-11 00:19:45'),(17,'17','Adolfo Monahan','Voluptatem facere veniam vitae.','Temporibus laudantium voluptatem aspernatur exercitationem.','Dolore tempora nostrum consequuntur iste ut.','2','delpha.ratke@example.com','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','afevOetpyV','2020-02-11 00:19:45','2020-02-11 00:19:45'),(18,'18','Lea Pacocha','Modi molestias quasi consectetur aut.','Quibusdam consequatur rerum iste asperiores quia est quas.','Ut labore ut et quis qui qui ratione minus.','7','bernier.lowell@example.com','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','sV64mvRZaA','2020-02-11 00:19:45','2020-02-11 00:19:45'),(19,'19','Ruby Kuvalis I','Placeat non a non excepturi officiis aut.','Qui aspernatur dolore omnis.','Adipisci fuga ut et neque autem velit minima.','0','ibrakus@example.com','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','p1sey5J2zA','2020-02-11 00:19:45','2020-02-11 00:19:45'),(20,'20','Abigayle Ebert MD','Ab eos et et sequi commodi saepe voluptas.','Autem qui quidem illo commodi nobis suscipit aliquam.','Eius quisquam fugit quae molestias.','4','gblock@example.org','2020-02-11 00:19:44','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','xut9jMQx48','2020-02-11 00:19:45','2020-02-11 00:19:45'),(21,'1206855593','Martin','Ronquillo','Vargas','Pedro Carbo y 5 de Junio','2735416','marticarcel@hotmail.com',NULL,'$2y$10$5Q0AhOjSop5liI/BR84w5OCNCb627ZLtqf5cew3y.dw7e0fN8vau2',NULL,'2020-02-11 00:36:12','2020-02-11 00:36:12');

/*Table structure for table `vehiculos` */

DROP TABLE IF EXISTS `vehiculos`;

CREATE TABLE `vehiculos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `placa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marca` enum('Chevrolet','Nissan','Toyota','Ford','Suzuki','Mercedes','Jeep','Fiat') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modelo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observacion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cliente_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `placa` (`placa`),
  KEY `FK_vehiculos_clientes` (`cliente_id`),
  CONSTRAINT `FK_vehiculos_clientes` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `vehiculos` */

insert  into `vehiculos`(`id`,`placa`,`marca`,`modelo`,`color`,`observacion`,`cliente_id`,`created_at`,`updated_at`) values (2,'GSH-524','Toyota','fortune','Blanco','Pequeño rayon',1,NULL,'2020-02-11 22:50:19'),(5,'HSD-265','Ford','F-150','Negro','ventanas portatiles',1,'2020-02-11 19:03:04','2020-02-11 19:03:04');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
