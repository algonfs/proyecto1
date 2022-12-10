-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-06-2020 a las 17:09:12
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ticket`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buses`
--

CREATE TABLE `buses` (
  `id` int(10) UNSIGNED NOT NULL,
  `idmarca` int(10) UNSIGNED NOT NULL,
  `planta` int(11) NOT NULL,
  `placa` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacidad` int(11) NOT NULL,
  `codicion` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `buses`
--

INSERT INTO `buses` (`id`, `idmarca`, `planta`, `placa`, `capacidad`, `codicion`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '123v', 23, 0, '2020-06-18 05:06:28', '2020-06-18 20:44:53'),
(2, 4, 2, 'N34353', 80, 1, '2020-06-18 15:36:20', '2020-06-18 16:58:46'),
(3, 4, 1, 'N4865', 34, 1, '2020-06-18 17:00:33', '2020-06-18 17:00:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conductores`
--

CREATE TABLE `conductores` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brevete` int(11) NOT NULL,
  `direccion` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `conductores`
--

INSERT INTO `conductores` (`id`, `nombre`, `cedula`, `brevete`, `direccion`, `telefono`, `condicion`, `created_at`, `updated_at`) VALUES
(1, 'Carlos', '12345', 12323423, 'av aqui mismo', 12432424, 1, '2020-06-18 05:25:15', '2020-06-18 17:09:50'),
(2, 'Roberto', '14184765', 124128, 'av. la paz', 76209845, 1, '2020-06-18 15:26:58', '2020-06-18 17:10:05'),
(3, 'guido', '455464', 1234, 'los santos', 12345678, 1, '2020-06-18 20:46:17', '2020-06-18 20:46:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detelle_ventas`
--

CREATE TABLE `detelle_ventas` (
  `id` int(10) UNSIGNED NOT NULL,
  `idventa` int(10) UNSIGNED NOT NULL,
  `idruta` int(10) UNSIGNED NOT NULL,
  `precio` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detelle_ventas`
--

INSERT INTO `detelle_ventas` (`id`, `idventa`, `idruta`, `precio`) VALUES
(1, 1, 1, '12.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(10) UNSIGNED NOT NULL,
  `marca` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `marca`, `condicion`, `created_at`, `updated_at`) VALUES
(1, 'Nissan', 1, '2020-06-18 05:06:06', '2020-06-18 05:06:06'),
(2, 'Ferrari', 1, '2020-06-18 05:06:13', '2020-06-18 05:06:13'),
(3, 'Auddi', 1, '2020-06-18 15:35:52', '2020-06-18 15:35:52'),
(4, 'Toyota', 1, '2020-06-18 15:35:59', '2020-06-18 15:35:59'),
(5, 'Nissan', 1, '2020-06-18 20:44:38', '2020-06-18 20:44:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(194, '2014_10_12_100000_create_password_resets_table', 1),
(195, '2019_08_19_000000_create_failed_jobs_table', 1),
(196, '2020_05_25_132620_create_marcas_table', 1),
(197, '2020_05_25_193926_create_buses_table', 1),
(198, '2020_05_25_194108_create_conductores_table', 1),
(199, '2020_06_16_043221_create_personas_table', 1),
(200, '2020_06_16_050430_create_roles_table', 1),
(201, '2020_06_17_000000_create_users_table', 1),
(202, '2020_06_17_042342_create_rutas_table', 1),
(203, '2020_06_17_045520_create_viajes_table', 1),
(204, '2020_06_17_190825_create_ventas_table', 1),
(205, '2020_06_17_191700_create_detelle_ventas_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `cedula`, `direccion`, `telefono`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Mauricio', '12312', 'asdas', 12312312, 'come@gmail.com', '2020-06-18 00:46:31', '2020-06-18 17:23:11'),
(2, 'Elsa', '87456', 'san roque', 12434456, 'aa@gmail.com', '2020-06-18 00:46:48', '2020-06-18 17:22:55'),
(3, 'Alvaro', '123124', 'av panamericana', 76245694, 'goustluffy@gmail.com', '2020-06-18 00:49:02', '2020-06-18 17:22:19'),
(4, 'juan', '234365', '23423', 76298756, NULL, '2020-06-18 00:49:33', '2020-06-18 17:16:59'),
(5, 'Ramon', '124422', 'av. copacabana', 1775371, NULL, '2020-06-18 15:30:48', '2020-06-18 15:30:48'),
(13, 'Samanta', '231312312', 'av. juan pablo II', 12312345, 'a2', '2020-06-18 15:33:24', '2020-06-18 17:22:43'),
(15, 'Romina', '87356', 'av. bolivar', 87456345, 'sabetodo@gamil.com', '2020-06-18 18:24:25', '2020-06-18 18:24:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `condicion`) VALUES
(1, 'Administrador', 'Administradores de área', 1),
(2, 'Vendedor', 'Vendedor área venta', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `id` int(10) UNSIGNED NOT NULL,
  `destino` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`id`, `destino`, `precio`, `condicion`, `created_at`, `updated_at`) VALUES
(1, 'Oruro', '50.00', 1, '2020-06-18 00:45:42', '2020-06-18 17:23:40'),
(2, 'Santa Cruz', '343.00', 1, '2020-06-18 02:44:49', '2020-06-18 02:44:49'),
(3, 'Pando', '120.00', 1, '2020-06-18 15:27:15', '2020-06-18 15:27:15'),
(4, 'Tarija', '100.00', 1, '2020-06-18 17:23:28', '2020-06-18 17:23:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1',
  `idrol` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `usuario`, `password`, `condicion`, `idrol`, `remember_token`) VALUES
(4, '1234', '$2y$10$D6lZSJUs.I0t4skltIrvgeex3t44pN2roJHae96viBBm0/7mp9lEu', 1, 2, NULL),
(3, 'admin', '$2y$10$sPzWsTVObX1zx8WCz9iHUeY07Yn8RSqUy6HMbyx6obWQ141af1INS', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(10) UNSIGNED NOT NULL,
  `idcliente` int(10) UNSIGNED NOT NULL,
  `idusuario` int(10) UNSIGNED NOT NULL,
  `tipo_comprobante` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serie_comprobante` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_comprobante` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `estado` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `idcliente`, `idusuario`, `tipo_comprobante`, `serie_comprobante`, `num_comprobante`, `fecha_hora`, `total`, `estado`, `created_at`, `updated_at`) VALUES
(1, 4, 3, 'BOLETA', '123', '123', '2020-06-16 09:53:46', '123.00', 'Anulado', NULL, '2020-06-18 17:25:41'),
(2, 5, 3, 'TICKET', '123', '123', '2020-06-18 09:24:47', '123.00', 'Anulado', NULL, '2020-06-18 20:48:08'),
(3, 1, 3, 'BOLETA', '646', '645', '2020-06-18 09:58:33', '345.00', 'Registrado', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes`
--

CREATE TABLE `viajes` (
  `id` int(10) UNSIGNED NOT NULL,
  `idconductor` int(10) UNSIGNED NOT NULL,
  `idbus` int(10) UNSIGNED NOT NULL,
  `idruta` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `viajes`
--

INSERT INTO `viajes` (`id`, `idconductor`, `idbus`, `idruta`, `descripcion`, `condicion`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 'Tv, Wifi', 1, '2020-06-18 05:25:42', '2020-06-18 05:25:42'),
(2, 1, 1, 1, 'cama,tv cable', 1, '2020-06-18 15:16:31', '2020-06-18 15:16:31'),
(3, 3, 3, 4, 'tv, baños', 1, '2020-06-18 20:49:22', '2020-06-18 20:49:22');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buses_idmarca_foreign` (`idmarca`);

--
-- Indices de la tabla `conductores`
--
ALTER TABLE `conductores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detelle_ventas`
--
ALTER TABLE `detelle_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detelle_ventas_idventa_foreign` (`idventa`),
  ADD KEY `detelle_ventas_idruta_foreign` (`idruta`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personas_cedula_unique` (`cedula`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_nombre_unique` (`nombre`);

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `users_usuario_unique` (`usuario`),
  ADD KEY `users_id_foreign` (`id`),
  ADD KEY `users_idrol_foreign` (`idrol`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ventas_idcliente_foreign` (`idcliente`),
  ADD KEY `ventas_idusuario_foreign` (`idusuario`);

--
-- Indices de la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `viajes_idconductor_foreign` (`idconductor`),
  ADD KEY `viajes_idbus_foreign` (`idbus`),
  ADD KEY `viajes_idruta_foreign` (`idruta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `buses`
--
ALTER TABLE `buses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `conductores`
--
ALTER TABLE `conductores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detelle_ventas`
--
ALTER TABLE `detelle_ventas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `viajes`
--
ALTER TABLE `viajes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `buses`
--
ALTER TABLE `buses`
  ADD CONSTRAINT `buses_idmarca_foreign` FOREIGN KEY (`idmarca`) REFERENCES `marcas` (`id`);

--
-- Filtros para la tabla `detelle_ventas`
--
ALTER TABLE `detelle_ventas`
  ADD CONSTRAINT `detelle_ventas_idruta_foreign` FOREIGN KEY (`idruta`) REFERENCES `rutas` (`id`),
  ADD CONSTRAINT `detelle_ventas_idventa_foreign` FOREIGN KEY (`idventa`) REFERENCES `ventas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_foreign` FOREIGN KEY (`id`) REFERENCES `personas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_idrol_foreign` FOREIGN KEY (`idrol`) REFERENCES `roles` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_idcliente_foreign` FOREIGN KEY (`idcliente`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `ventas_idusuario_foreign` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD CONSTRAINT `viajes_idbus_foreign` FOREIGN KEY (`idbus`) REFERENCES `buses` (`id`),
  ADD CONSTRAINT `viajes_idconductor_foreign` FOREIGN KEY (`idconductor`) REFERENCES `conductores` (`id`),
  ADD CONSTRAINT `viajes_idruta_foreign` FOREIGN KEY (`idruta`) REFERENCES `rutas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
