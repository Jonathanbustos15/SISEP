--------------------------------------

--
-- Estructura de tabla para la tabla `actor`
--

CREATE TABLE `actor` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `fkID_tipo` int(11) NOT NULL,
  `fkID_tipo_vinculacion` int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apropiacion_actor`
--

CREATE TABLE `apropiacion_actor` (
  `pkID` int(11) NOT NULL,
  `fkID_apropiacion` int(11) NOT NULL,
  `fkID_actor` int(11) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apropiacion_social`
--

CREATE TABLE `apropiacion_social` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `fkID_lugar` int(11) NOT NULL,
  `fecha_inicial` date NOT NULL,
  `fecha_final` date NOT NULL,
  `numero_horas` int(11) NOT NULL,
  `num_total_participantes` int(11) NOT NULL,
  `num_total_estudiantes` int(11) NOT NULL,
  `num_docentes` int(11) NOT NULL,
  `fkID_tipo` int(11) NOT NULL,
  `fkID_coordinador` int(11) NOT NULL,
  `fkID_tematica` int(11) NOT NULL,
  `url_archivo` varchar(250) NOT NULL
);

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL
);

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`pkID`, `nombre`) VALUES
(1, 'Amazonas'),
(2, 'Antioquia'),
(3, 'Arauca'),
(4, 'Atlántico'),
(5, 'Bogotá'),
(6, 'Bolívar'),
(7, 'Boyacá'),
(8, 'Caldas'),
(9, 'Caquetá'),
(10, 'Casanare'),
(11, 'Cauca'),
(12, 'Cesar'),
(13, 'Chocó'),
(14, 'Córdoba'),
(15, 'Cundinamarca'),
(16, 'Guainía'),
(17, 'Guaviare'),
(18, 'Huila'),
(19, 'La Guajira'),
(20, 'Magdalena'),
(21, 'Meta'),
(22, 'Nariño'),
(23, 'Norte de Santander'),
(24, 'Putumayo'),
(25, 'Quindío'),
(26, 'Risaralda'),
(27, 'San Andrés y Providencia'),
(28, 'Santander'),
(29, 'Sucre'),
(30, 'Tolima'),
(31, 'Valle del Cauca'),
(32, 'Vaupés'),
(33, 'Vichada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `novedades` text NOT NULL,
  `url_imagen` varchar(250) NOT NULL,
  `url_logo` varchar(250) NOT NULL,
  `lema` varchar(100) NOT NULL,
  `fecha_creacion` date NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `infraestructura`
--

CREATE TABLE `infraestructura` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `descripcion` text NOT NULL,
  `url_archivo` varchar(250) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE `institucion` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `telefono` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `codigo_dane` varchar(250) NOT NULL,
  `fkID_departamento` int(11) DEFAULT NULL,
  `fkID_municipio` int(11) DEFAULT NULL,
  `fkID_zona` int(11) DEFAULT NULL,
  `fkID_tipo_escuela` int(11) DEFAULT NULL,
  `fkID_tipo_sede` int(11) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion_infraestructura`
--

CREATE TABLE `institucion_infraestructura` (
  `pkID` int(11) NOT NULL,
  `fkID_institucion` int(11) NOT NULL,
  `fkID_infraestructura` int(11) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar_apropiacion`
--

CREATE TABLE `lugar_apropiacion` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `telefono` varchar(250) NOT NULL
) ;

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `fkID_departamento` int(11) NOT NULL
) ;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`pkID`, `nombre`, `fkID_departamento`) VALUES
(1, 'Leticia', 1),
(2, 'Puerto Nariño', 1),
(3, 'Abejorral', 2),
(4, 'Abriaquí', 2),
(5, 'Alejandría', 2),
(6, 'Amagá', 2),
(7, 'Amalfi', 2),
(8, 'Andes', 2),
(9, 'Angelópolis', 2),
(10, 'Angostura', 2),
(11, 'Anorí', 2),
(12, 'Anzá', 2),
(13, 'Apartadó', 2),
(14, 'Arboletes', 2),
(15, 'Argelia', 2),
(16, 'Armenia', 2),
(17, 'Barbosa', 2),
(18, 'Bello', 2),
(19, 'Belmira', 2),
(20, 'Betania', 2),
(21, 'Betulia', 2),
(22, 'Ciudad Bolívar', 2),
(23, 'Briceño', 2),
(24, 'Buriticá', 2),
(25, 'Cáceres', 2),
(26, 'Caicedo', 2),
(27, 'Caldas', 2),
(28, 'Campamento', 2),
(29, 'Cañasgordas', 2),
(30, 'Caracolí', 2),
(31, 'Caramanta', 2),
(32, 'Carepa', 2),
(33, 'Carolina del Príncipe', 2),
(34, 'Caucasia', 2),
(35, 'Cocorná', 2),
(36, 'Chigorodó', 2),
(37, 'Cisneros', 2),
(38, 'Concepción', 2),
(39, 'Concordia', 2),
(40, 'Copacabana', 2),
(41, 'Dabeiba', 2),
(42, 'Donmatías', 2),
(43, 'Ebéjico', 2),
(44, 'El Bagre', 2),
(45, 'El Carmen de Viboral', 2),
(46, 'El Peñol', 2),
(47, 'El Retiro', 2),
(48, 'El Santuario', 2),
(49, 'Entrerríos', 2),
(50, 'Envigado', 2),
(51, 'Fredonia', 2),
(52, 'Frontino', 2),
(53, 'Giraldo', 2),
(54, 'Girardota', 2),
(55, 'Gómez Plata', 2),
(56, 'Granada', 2),
(57, 'Guadalupe', 2),
(58, 'Guarne', 2),
(59, 'Guatapé', 2),
(60, 'Heliconia', 2),
(61, 'Hispania', 2),
(62, 'Itagüí', 2),
(63, 'Ituango', 2),
(64, 'Jardín', 2),
(65, 'Jericó', 2),
(66, 'La Ceja', 2),
(67, 'La Estrella', 2),
(68, 'La Pintada', 2),
(69, 'La Unión', 2),
(70, 'Liborina', 2),
(71, 'Maceo', 2),
(72, 'Marinilla', 2),
(73, 'Medellin', 2),
(74, 'Montebello', 2),
(75, 'Murindó', 2),
(76, 'Mutatá', 2),
(77, 'Nariño', 2),
(78, 'Nechí', 2),
(79, 'Necoclí', 2),
(80, 'Olaya', 2),
(81, 'Peque', 2),
(82, 'Pueblorrico', 2),
(83, 'Puerto Berrío', 2),
(84, 'Puerto Nare', 2),
(85, 'Puerto Triunfo', 2),
(86, 'Remedios', 2),
(87, 'Rionegro', 2),
(88, 'Sabanalarga', 2),
(89, 'Sabaneta', 2),
(90, 'Salgar', 2),
(91, 'San Andrés de Cuerquia', 2),
(92, 'San Carlos', 2),
(93, 'San Francisco', 2),
(94, 'San Jerónimo', 2),
(95, 'San José de la Montaña', 2),
(96, 'San Juan de Urabá', 2),
(97, 'San Luis', 2),
(98, 'San Rafael', 2),
(99, 'San Roque', 2),
(100, 'San Pedro de los Milagros', 2),
(101, 'San Pedro de Urabá', 2),
(102, 'San Vicente', 2),
(103, 'Santa Bárbara', 2),
(104, 'Santa Fe de Antioquia', 2),
(105, 'Santa Rosa de Osos', 2),
(106, 'Santo Domingo', 2),
(107, 'Segovia', 2),
(108, 'Sonsón', 2),
(109, 'Sopetrán', 2),
(110, 'Támesis', 2),
(111, 'Tarazá', 2),
(112, 'Tarso', 2),
(113, 'Titiribí', 2),
(114, 'Toledo', 2),
(115, 'Turbo', 2),
(116, 'Uramita', 2),
(117, 'Urrao', 2),
(118, 'Valdivia', 2),
(119, 'Valparaíso', 2),
(120, 'Vegachí', 2),
(121, 'Venecia', 2),
(122, 'Vigía del Fuerte', 2),
(123, 'Yalí', 2),
(124, 'Yarumal', 2),
(125, 'Yolombó', 2),
(126, 'Yondó', 2),
(127, 'Zaragoza', 2),
(128, 'Arauca', 3),
(129, 'Arauquita', 3),
(130, 'Cravo Norte', 3),
(131, 'Fortul', 3),
(132, 'Puerto Rondón', 3),
(133, 'Saravena', 3),
(134, 'Tame', 3),
(135, 'Barranquilla', 4),
(136, 'Baranoa', 4),
(137, 'Campo de la Cruz', 4),
(138, 'Candelaria', 4),
(139, 'Galapa', 4),
(140, 'Juan de Acosta', 4),
(141, 'Luruaco', 4),
(142, 'Malambo', 4),
(143, 'Manatí', 4),
(144, 'Palmar de Varela', 4),
(145, 'Piojó', 4),
(146, 'Polonuevo', 4),
(147, 'Ponedera', 4),
(148, 'Puerto Colombia', 4),
(149, 'Repelón', 4),
(150, 'Sabanagrande', 4),
(151, 'Sabanalarga', 4),
(152, 'Santa Lucía', 4),
(153, 'Santo Tomás', 4),
(154, 'Soledad', 4),
(155, 'Suán', 4),
(156, 'Tubará', 4),
(157, 'Usiacurí', 4),
(158, 'Bogotá', 5),
(159, 'Achí', 6),
(160, 'Altos del Rosario', 6),
(161, 'Arenal', 6),
(162, 'Arjona', 6),
(163, 'Arroyohondo', 6),
(164, 'Barranco de Loba', 6),
(165, 'Calamar', 6),
(166, 'Cantagallo', 6),
(167, 'El Carmen de Bolívar', 6),
(168, 'Cartagena de Indias', 6),
(169, 'Cicuco', 6),
(170, 'Clemencia', 6),
(171, 'Córdoba', 6),
(172, 'El Guamo', 6),
(173, 'El Peñón', 6),
(174, 'Hatillo de Loba', 6),
(175, 'Magangué', 6),
(176, 'Mahates', 6),
(177, 'Margarita', 6),
(178, 'María La Baja', 6),
(179, 'Montecristo', 6),
(180, 'Morales', 6),
(181, 'Norosí', 6),
(182, 'Pinillos', 6),
(183, 'Regidor', 6),
(184, 'Río Viejo', 6),
(185, 'San Cristóbal', 6),
(186, 'San Estanislao', 6),
(187, 'San Fernando', 6),
(188, 'San Jacinto', 6),
(189, 'San Jacinto del Cauca', 6),
(190, 'San Juan Nepomuceno', 6),
(191, 'San Martín de Loba', 6),
(192, 'San Pablo', 6),
(193, 'Santa Catalina', 6),
(194, 'Santa Cruz de Mompox', 6),
(195, 'Santa Rosa', 6),
(196, 'Santa Rosa del Sur', 6),
(197, 'Simití', 6),
(198, 'Soplaviento', 6),
(199, 'Talaigua Nuevo', 6),
(200, 'Tiquisio', 6),
(201, 'Turbaco', 6),
(202, 'Turbaná', 6),
(203, 'Villanueva', 6),
(204, 'Zambrano', 6),
(205, 'Almeida', 7),
(206, 'Aquitania', 7),
(207, 'Arcabuco', 7),
(208, 'Belén', 7),
(209, 'Berbeo', 7),
(210, 'Betéitiva', 7),
(211, 'Boavita', 7),
(212, 'Boyacá', 7),
(213, 'Briceño', 7),
(214, 'Buenavista', 7),
(215, 'Busbanzá', 7),
(216, 'Caldas', 7),
(217, 'Campohermoso', 7),
(218, 'Cerinza', 7),
(219, 'Chinavita', 7),
(220, 'Chiquinquirá', 7),
(221, 'Chíquiza', 7),
(222, 'Chiscas', 7),
(223, 'Chita', 7),
(224, 'Chitaraque', 7),
(225, 'Chivatá', 7),
(226, 'Chivor', 7),
(227, 'Ciénega', 7),
(228, 'Cómbita', 7),
(229, 'Coper', 7),
(230, 'Corrales', 7),
(231, 'Covarachía', 7),
(232, 'Cubará', 7),
(233, 'Cucaita', 7),
(234, 'Cuitiva', 7),
(235, 'Duitama', 7),
(236, 'El Cocuy', 7),
(237, 'El Espino', 7),
(238, 'Firavitoba', 7),
(239, 'Floresta', 7),
(240, 'Gachantivá', 7),
(241, 'Gámeza', 7),
(242, 'Garagoa', 7),
(243, 'Guacamayas', 7),
(244, 'Guateque', 7),
(245, 'Guayatá', 7),
(246, 'Guicán de la Sierra', 7),
(247, 'Iza', 7),
(248, 'Jenesano', 7),
(249, 'Jericó', 7),
(250, 'La Capilla', 7),
(251, 'La Uvita', 7),
(252, 'La Victoria', 7),
(253, 'Labranzagrande', 7),
(254, 'Macanal', 7),
(255, 'Maripi', 7),
(256, 'Miraflores', 7),
(257, 'Mongua', 7),
(258, 'Monguí', 7),
(259, 'Moniquirá', 7),
(260, 'Motavita', 7),
(261, 'Muzo', 7),
(262, 'Nobsa', 7),
(263, 'Nuevo Colón', 7),
(264, 'Oicatá', 7),
(265, 'Otanche', 7),
(266, 'Pachavita', 7),
(267, 'Páez', 7),
(268, 'Paipa', 7),
(269, 'Pajarito', 7),
(270, 'Panqueba', 7),
(271, 'Pauna', 7),
(272, 'Paya', 7),
(273, 'Paz de Río', 7),
(274, 'Pesca', 7),
(275, 'Pisba', 7),
(276, 'Puerto Boyacá', 7),
(277, 'Quípama', 7),
(278, 'Ramiriquí', 7),
(279, 'Ráquira', 7),
(280, 'Rondón', 7),
(281, 'Saboyá', 7),
(282, 'Sáchica', 7),
(283, 'Samacá', 7),
(284, 'San Eduardo', 7),
(285, 'San José de Pare', 7),
(286, 'San Mateo', 7),
(287, 'San Miguel de Sema', 7),
(288, 'San Pablo de Borbur', 7),
(289, 'Santa Maria', 7),
(290, 'Santa Rosa de Viterbo', 7),
(291, 'Santa Sofía', 7),
(292, 'Santana', 7),
(293, 'Sativanorte', 7),
(294, 'Sativasur', 7),
(295, 'Siachoque', 7),
(296, 'Soatá', 7),
(297, 'Socha', 7),
(298, 'Socotá', 7),
(299, 'Sogamoso', 7),
(300, 'Somondoco', 7),
(301, 'Sora', 7),
(302, 'Soracá', 7),
(303, 'Sotaquirá', 7),
(304, 'Susacón', 7),
(305, 'Sutamarchán', 7),
(306, 'Sutatenza', 7),
(307, 'Tasco', 7),
(308, 'Tenza', 7),
(309, 'Tibaná', 7),
(310, 'Tibasosa', 7),
(311, 'Tinjacá', 7),
(312, 'Tipacoque', 7),
(313, 'Toca', 7),
(314, 'Toguí', 7),
(315, 'Tópaga', 7),
(316, 'Tota', 7),
(317, 'Tunja', 7),
(318, 'Tununguá', 7),
(319, 'Turmequé', 7),
(320, 'Tuta', 7),
(321, 'Tutazá', 7),
(322, 'Umbitá', 7),
(323, 'Ventaquemada', 7),
(324, 'Villa de Leyva', 7),
(325, 'Viracachá', 7),
(326, 'Zetaquira', 7),
(327, 'Aguadas', 8),
(328, 'Anserma', 8),
(329, 'Aranzazu', 8),
(330, 'Belalcazar', 8),
(331, 'Chinchiná', 8),
(332, 'Filadelfia', 8),
(333, 'La Dorada', 8),
(334, 'La Merced', 8),
(335, 'Manizales', 8),
(336, 'Manzanares', 8),
(337, 'Marmato', 8),
(338, 'Marquetalia', 8),
(339, 'Marulanda', 8),
(340, 'Neira', 8),
(341, 'Norcasia', 8),
(342, 'Pacora', 8),
(343, 'Palestina', 8),
(344, 'Pensilvania', 8),
(345, 'Riosucio', 8),
(346, 'Risaralda', 8),
(347, 'Salamina', 8),
(348, 'Samana', 8),
(349, 'San Jose', 8),
(350, 'Supía', 8),
(351, 'Victoria', 8),
(352, 'Villamaría', 8),
(353, 'Viterbo', 8),
(354, 'Albania', 9),
(355, 'Belén Andaquies', 9),
(356, 'Cartagena del Chaira', 9),
(357, 'Curillo', 9),
(358, 'El Doncello', 9),
(359, 'El Paujil', 9),
(360, 'Florencia', 9),
(361, 'La Montañita', 9),
(362, 'Milán', 9),
(363, 'Morelia', 9),
(364, 'Puerto Rico', 9),
(365, 'San José de Fragua', 9),
(366, 'San  Vicente del Caguan', 9),
(367, 'Solano', 9),
(368, 'Solita', 9),
(369, 'Valparaíso', 9),
(370, 'Aguazul', 10),
(371, 'Chámeza', 10),
(372, 'Hato Corozal', 10),
(373, 'La Salina', 10),
(374, 'Maní', 10),
(375, 'Monterrey', 10),
(376, 'Nunchía', 10),
(377, 'Orocué', 10),
(378, 'Paz de Ariporo', 10),
(379, 'Pore', 10),
(380, 'Recetor', 10),
(381, 'Sabanalarga', 10),
(382, 'Sácama', 10),
(383, 'San Luis de Palenque', 10),
(384, 'Támara', 10),
(385, 'Tauramena', 10),
(386, 'Trinidad', 10),
(387, 'Villanueva', 10),
(388, 'Yopal', 10),
(389, 'Almaguer', 11),
(390, 'Argelia', 11),
(391, 'Balboa', 11),
(392, 'Bolívar', 11),
(393, 'Buenos Aires', 11),
(394, 'Cajibio', 11),
(395, 'Caldono', 11),
(396, 'Caloto', 11),
(397, 'Corinto', 11),
(398, 'El Tambo', 11),
(399, 'Florencia', 11),
(400, 'Guapi', 11),
(401, 'Inza', 11),
(402, 'Jambaló', 11),
(403, 'La Sierra', 11),
(404, 'La Vega', 11),
(405, 'López', 11),
(406, 'Mercaderes', 11),
(407, 'Miranda', 11),
(408, 'Morales', 11),
(409, 'Padilla', 11),
(410, 'Páez', 11),
(411, 'Patia (El Bordo)', 11),
(412, 'Piamonte', 11),
(413, 'Piendamo', 11),
(414, 'Popayán', 11),
(415, 'Puerto Tejada', 11),
(416, 'Purace', 11),
(417, 'Rosas', 11),
(418, 'San Sebastián', 11),
(419, 'Santander de Quilichao', 11),
(420, 'Santa Rosa', 11),
(421, 'Silvia', 11),
(422, 'Sotara', 11),
(423, 'Suárez', 11),
(424, 'Sucre', 11),
(425, 'Timbío', 11),
(426, 'Timbiquí', 11),
(427, 'Toribio', 11),
(428, 'Totoro', 11),
(429, 'Villa Rica', 11),
(430, 'Aguachica', 12),
(431, 'Agustín Codazzi', 12),
(432, 'Astrea', 12),
(433, 'Becerril', 12),
(434, 'Bosconia', 12),
(435, 'Chimichagua', 12),
(436, 'Chiriguaná', 12),
(437, 'Curumaní', 12),
(438, 'El Copey', 12),
(439, 'El Paso	Gamarra', 12),
(440, 'González', 12),
(441, 'La Gloria', 12),
(442, 'La Jagua Ibirico', 12),
(443, 'Manaure', 12),
(444, 'Balcón Del Cesar', 12),
(445, 'Pailitas', 12),
(446, 'Pelaya', 12),
(447, 'Pueblo Bello', 12),
(448, 'Río De Oro', 12),
(449, 'Robles (La Paz)', 12),
(450, 'San Alberto', 12),
(451, 'San Diego', 12),
(452, 'San Martín', 12),
(453, 'Tamalameque', 12),
(454, 'Valledupar', 12),
(455, 'Acandí', 13),
(456, 'Alto Baudó (Pie de Pepe)', 13),
(457, 'Atrato', 13),
(458, 'Bagadó', 13),
(459, 'Bahía Solano', 13),
(460, 'Bajo Baudó (Pizarro)', 13),
(461, 'Belén de Bajirá', 13),
(462, 'Bojayá (Bellavista)', 13),
(463, 'Cantón de San Pablo', 13),
(464, 'El Carmen de Atrato', 13),
(465, 'Cértegui', 13),
(466, 'Condoto', 13),
(467, 'El Carmen del Darién', 13),
(468, 'Istmina', 13),
(469, 'Juradó', 13),
(470, 'Litoral del San Juan', 13),
(471, 'Lloró', 13),
(472, 'Medio Atrato', 13),
(473, 'Medio Baudó (Pto. Meluk)', 13),
(474, 'Medio San Juan', 13),
(475, 'Nóvita', 13),
(476, 'Nuquí', 13),
(477, 'Quibdó', 13),
(478, 'Riosucio', 13),
(479, 'Río Iró', 13),
(480, 'Río Quito', 13),
(481, 'San José del Palmar', 13),
(482, 'Sipí', 13),
(483, 'Tadó', 13),
(484, 'Unguía', 13),
(485, 'Unión Panamericana', 13),
(486, 'Ayapel', 14),
(487, 'Buenavista', 14),
(488, 'Canalete', 14),
(489, 'Cereté', 14),
(490, 'Chimá', 14),
(491, 'Chinú', 14),
(492, 'Ciénaga de Oro', 14),
(493, 'Cotorra', 14),
(494, 'La Apartada', 14),
(495, 'Los Córdobas', 14),
(496, 'Momil', 14),
(497, 'Montelíbano', 14),
(498, 'Montería', 14),
(499, 'Moñitos', 14),
(500, 'Planeta Rica', 14),
(501, 'Pueblo Nuevo', 14),
(502, 'Puerto Escondido', 14),
(503, 'Puerto Libertador', 14),
(504, 'Purísima', 14),
(505, 'Sahagún', 14),
(506, 'San Andrés de Sotavento', 14),
(507, 'San Antero', 14),
(508, 'San Bernardo del Viento', 14),
(509, 'San Carlos', 14),
(510, 'San José de Uré', 14),
(511, 'San Pelayo', 14),
(512, 'Santa Cruz de Lorica', 14),
(513, 'Tierralta', 14),
(514, 'Tuchín', 14),
(515, 'Valencia', 14),
(516, 'Agua de Dios', 15),
(517, 'Alban', 15),
(518, 'Anapoima', 15),
(519, 'Anolaima', 15),
(520, 'Arbelaez', 15),
(521, 'Beltrán', 15),
(522, 'Bituima', 15),
(523, 'Bojacá', 15),
(524, 'Cabrera', 15),
(525, 'Cachipay', 15),
(526, 'Cajicá', 15),
(527, 'Caparrapí', 15),
(528, 'Caqueza', 15),
(529, 'Carmen de Carupa', 15),
(530, 'Chaguaní', 15),
(531, 'Chia', 15),
(532, 'Chipaque', 15),
(533, 'Choachí', 15),
(534, 'Chocontá', 15),
(535, 'Cogua', 15),
(536, 'Cota', 15),
(537, 'Cucunubá', 15),
(538, 'El Colegio', 15),
(539, 'El Peñón', 15),
(540, 'El Rosal1', 15),
(541, 'Facatativa', 15),
(542, 'Fómeque', 15),
(543, 'Fosca', 15),
(544, 'Funza', 15),
(545, 'Fúquene', 15),
(546, 'Fusagasuga', 15),
(547, 'Gachalá', 15),
(548, 'Gachancipá', 15),
(549, 'Gacheta', 15),
(550, 'Gama', 15),
(551, 'Girardot', 15),
(552, 'Granada2', 15),
(553, 'Guachetá', 15),
(554, 'Guaduas', 15),
(555, 'Guasca', 15),
(556, 'Guataquí', 15),
(557, 'Guatavita', 15),
(558, 'Guayabal de Siquima', 15),
(559, 'Guayabetal', 15),
(560, 'Gutiérrez', 15),
(561, 'Jerusalén', 15),
(562, 'Junín', 15),
(563, 'La Calera', 15),
(564, 'La Mesa', 15),
(565, 'La Palma', 15),
(566, 'La Peña', 15),
(567, 'La Vega', 15),
(568, 'Lenguazaque', 15),
(569, 'Machetá', 15),
(570, 'Madrid', 15),
(571, 'Manta', 15),
(572, 'Medina', 15),
(573, 'Mosquera', 15),
(574, 'Nariño', 15),
(575, 'Nemocón', 15),
(576, 'Nilo', 15),
(577, 'Nimaima', 15),
(578, 'Nocaima', 15),
(579, 'Ospina Pérez', 15),
(580, 'Pacho', 15),
(581, 'Paime', 15),
(582, 'Pandi', 15),
(583, 'Paratebueno', 15),
(584, 'Pasca', 15),
(585, 'Puerto Salgar', 15),
(586, 'Pulí', 15),
(587, 'Quebradanegra', 15),
(588, 'Quetame', 15),
(589, 'Quipile', 15),
(590, 'Rafael Reyes', 15),
(591, 'Ricaurte', 15),
(592, 'San  Antonio del Tequendama', 15),
(593, 'San Bernardo', 15),
(594, 'San Cayetano', 15),
(595, 'San Juan de Rioseco', 15),
(596, 'San Francisco', 15),
(597, 'Sasaima', 15),
(598, 'Sesquilé', 15),
(599, 'Sibaté', 15),
(600, 'Silvania', 15),
(601, 'Simijaca', 15),
(602, 'Soacha', 15),
(603, 'Sopo', 15),
(604, 'Subachoque', 15),
(605, 'Suesca', 15),
(606, 'Supatá', 15),
(607, 'Susa', 15),
(608, 'Sutatausa', 15),
(609, 'Tabio', 15),
(610, 'Tausa', 15),
(611, 'Tena', 15),
(612, 'Tenjo', 15),
(613, 'Tibacuy', 15),
(614, 'Tibirita', 15),
(615, 'Tocaima', 15),
(616, 'Tocancipá', 15),
(617, 'Topaipí', 15),
(618, 'Ubalá', 15),
(619, 'Ubaque', 15),
(620, 'Ubaté', 15),
(621, 'Une', 15),
(622, 'Utica', 15),
(623, 'Vergara', 15),
(624, 'Viani', 15),
(625, 'Villagomez', 15),
(626, 'Villapinzón', 15),
(627, 'Villeta', 15),
(628, 'Viota', 15),
(629, 'Yacopí', 15),
(630, 'Zipacón', 15),
(631, 'Zipaquirá', 15),
(632, 'Inírida', 16),
(633, 'Calamar', 17),
(634, 'El Retorno', 17),
(635, 'Miraflores', 17),
(636, 'San José del Guaviare', 17),
(637, 'Acevedo', 18),
(638, 'Agrado', 18),
(639, 'Aipe', 18),
(640, 'Algeciras', 18),
(641, 'Altamira', 18),
(642, 'Baraya', 18),
(643, 'Campoalegre', 18),
(644, 'Colombia', 18),
(645, 'Elias', 18),
(646, 'Garzón', 18),
(647, 'Gigante', 18),
(648, 'Guadalupe', 18),
(649, 'Hobo', 18),
(650, 'Iquira', 18),
(651, 'Isnos', 18),
(652, 'La Argentina', 18),
(653, 'La Plata', 18),
(654, 'Nataga', 18),
(655, 'Neiva', 18),
(656, 'Oporapa', 18),
(657, 'Paicol', 18),
(658, 'Palermo', 18),
(659, 'Palestina', 18),
(660, 'Pital', 18),
(661, 'Pitalito', 18),
(662, 'Rivera', 18),
(663, 'Saladoblanco', 18),
(664, 'San Agustín', 18),
(665, 'Santa Maria', 18),
(666, 'Suaza', 18),
(667, 'Tarqui', 18),
(668, 'Tesalia', 18),
(669, 'Tello', 18),
(670, 'Teruel', 18),
(671, 'Timana', 18),
(672, 'Villavieja', 18),
(673, 'Yaguara', 18),
(674, 'Albania', 19),
(675, 'Barrancas', 19),
(676, 'Dibulla', 19),
(677, 'Distraccion', 19),
(678, 'El Molino', 19),
(679, 'Fonseca', 19),
(680, 'Hatonuevo', 19),
(681, 'La Jagua del Pilar', 19),
(682, 'Maicao', 19),
(683, 'Manaure', 19),
(684, 'Riohacha', 19),
(685, 'San Juan del Cesar', 19),
(686, 'Uribia', 19),
(687, 'Urumita', 19),
(688, 'Villanueva', 19),
(689, 'Algarrobo', 20),
(690, 'Aracataca', 20),
(691, 'Ariguani', 20),
(692, 'Cerro San Antonio', 20),
(693, 'Chivolo', 20),
(694, 'Cienaga', 20),
(695, 'Concordia', 20),
(696, 'El Banco', 20),
(697, 'El Piñon', 20),
(698, 'El Reten', 20),
(699, 'Fundacion', 20),
(700, 'Guamal', 20),
(701, 'Nueva Granada', 20),
(702, 'Pedraza', 20),
(703, 'Pijiño Del Carmen', 20),
(704, 'Pivijay', 20),
(705, 'Plato', 20),
(706, 'Puebloviejo', 20),
(707, 'Remolino', 20),
(708, 'Sabanas De San Angel', 20),
(709, 'Santa Ana', 20),
(710, 'Santa Barbara De Pinto', 20),
(711, 'Santa Marta', 20),
(712, 'San Sebastian De Buenavista', 20),
(713, 'San Zenon', 20),
(714, 'Salamina', 20),
(715, 'Sitionuevo', 20),
(716, 'Tenerife', 20),
(717, 'Zapayan', 20),
(718, 'Zona Bananera', 20),
(719, 'Acacias', 21),
(720, 'Barranca de Upia', 21),
(721, 'Cabuyaro', 21),
(722, 'Castilla La Nueva', 21),
(723, 'Cubarral', 21),
(724, 'Cumaral', 21),
(725, 'El Calvario', 21),
(726, 'El Castillo', 21),
(727, 'El Dorado', 21),
(728, 'Fuente de Oro', 21),
(729, 'Granada', 21),
(730, 'Guamal', 21),
(731, 'Mapiripán', 21),
(732, 'Mesetas', 21),
(733, 'La Macarena', 21),
(734, 'La Uribe', 21),
(735, 'Lejanías', 21),
(736, 'Puerto Concordia', 21),
(737, 'Puerto Gaitán', 21),
(738, 'Puerto López', 21),
(739, 'Puerto Lleras', 21),
(740, 'Puerto Rico', 21),
(741, 'Restrepo', 21),
(742, 'San Carlos Guaroa', 21),
(743, 'San Juan de Arama', 21),
(744, 'San Juanito', 21),
(745, 'San Martín', 21),
(746, 'Villavicencio', 21),
(747, 'Vista Hermosa', 21),
(748, 'Alban', 22),
(749, 'Aldaña', 22),
(750, 'Ancuya', 22),
(751, 'Arboleda', 22),
(752, 'Barbacoas', 22),
(753, 'Belen', 22),
(754, 'Buesaco', 22),
(755, 'Colon(genova)', 22),
(756, 'Consaca', 22),
(757, 'Contadero', 22),
(758, 'Cordoba', 22),
(759, 'Cuaspud', 22),
(760, 'Cumbal', 22),
(761, 'Cumbitara', 22),
(762, 'Chachagui', 22),
(763, 'El charco', 22),
(764, 'El peñol', 22),
(765, 'El rosario', 22),
(766, 'El tablon', 22),
(767, 'El tambo', 22),
(768, 'Funes', 22),
(769, 'Guachucal', 22),
(770, 'Guaitarilla', 22),
(771, 'Gualmatan', 22),
(772, 'Iles', 22),
(773, 'Imues', 22),
(774, 'Ipiales', 22),
(775, 'La cruz', 22),
(776, 'La florida', 22),
(777, 'La llanada', 22),
(778, 'La tola', 22),
(779, 'La union', 22),
(780, 'Leiva', 22),
(781, 'Linares', 22),
(782, 'Los andes', 22),
(783, 'Magui', 22),
(784, 'Mallama', 22),
(785, 'Mosquera', 22),
(786, 'Nariño', 22),
(787, 'Olaya herrera', 22),
(788, 'Ospina', 22),
(789, 'Pasto', 22),
(790, 'Pizarro', 22),
(791, 'Policarpa', 22),
(792, 'Potosi', 22),
(793, 'Providencia', 22),
(794, 'Puerres', 22),
(795, 'Pupiales', 22),
(796, 'Ricaurte', 22),
(797, 'Roberto payan', 22),
(798, 'Samaniego', 22),
(799, 'Sandona', 22),
(800, 'San bernardo', 22),
(801, 'San lorenzo', 22),
(802, 'San pablo', 22),
(803, 'San pedro de cartago', 22),
(804, 'Santa barbara', 22),
(805, 'Santacruz', 22),
(806, 'Sapuyes', 22),
(807, 'Taminango', 22),
(808, 'Tangua', 22),
(809, 'Tumaco', 22),
(810, 'Tuquerres', 22),
(811, 'Yacuanquer', 22),
(812, 'Abrego', 23),
(813, 'Arboledas', 23),
(814, 'Bochalema', 23),
(815, 'Bucarasica', 23),
(816, 'Cácota', 23),
(817, 'Cáchira', 23),
(818, 'Chinácota', 23),
(819, 'Chitagá', 23),
(820, 'Convención', 23),
(821, 'Cúcuta', 23),
(822, 'Cucutilla', 23),
(823, 'Durania', 23),
(824, 'El Carmen', 23),
(825, 'El Tarra', 23),
(826, 'El Zulia', 23),
(827, 'Gramalote', 23),
(828, 'Hacari', 23),
(829, 'Herrán', 23),
(830, 'Labateca', 23),
(831, 'La Esperanza', 23),
(832, 'La Playa', 23),
(833, 'Los Patios', 23),
(834, 'Lourdes', 23),
(835, 'Mutiscua', 23),
(836, 'Ocaña', 23),
(837, 'Pamplona', 23),
(838, 'Pamplonita', 23),
(839, 'Puerto Santander', 23),
(840, 'Ragonvalia', 23),
(841, 'Salazar', 23),
(842, 'San Calixto', 23),
(843, 'San Cayetano', 23),
(844, 'Santiago', 23),
(845, 'Sardinata', 23),
(846, 'Silos', 23),
(847, 'Teorama', 23),
(848, 'Tibú', 23),
(849, 'Toledo', 23),
(850, 'Villacaro', 23),
(851, 'Villa del Rosario', 23),
(852, 'Colón', 24),
(853, 'Mocoa', 24),
(854, 'Orito', 24),
(855, 'Puerto Asís', 24),
(856, 'Puerto Caycedo', 24),
(857, 'Puerto Guzmán', 24),
(858, 'Puerto Leguízamo', 24),
(859, 'Sibundoy', 24),
(860, 'San Francisco', 24),
(861, 'San Miguel', 24),
(862, 'Santiago', 24),
(863, 'Valle del Guamuez', 24),
(864, 'Villagarzón', 24),
(865, 'Armenia', 25),
(866, 'Buenavista', 25),
(867, 'Calarcá', 25),
(868, 'Circasia', 25),
(869, 'Córdoba', 25),
(870, 'Filandia', 25),
(871, 'Génova', 25),
(872, 'La Tebaida', 25),
(873, 'Montenegro', 25),
(874, 'Pijao', 25),
(875, 'Quimbaya', 25),
(876, 'Salento', 25),
(877, 'Apia', 26),
(878, 'Balboa', 26),
(879, 'Belén de Umbría', 26),
(880, 'Dos Quebradas', 26),
(881, 'Guatica', 26),
(882, 'La Celia', 26),
(883, 'La Virginia', 26),
(884, 'Marsella', 26),
(885, 'Mistrato', 26),
(886, 'Pereira', 26),
(887, 'Pueblo Rico', 26),
(888, 'Quinchía', 26),
(889, 'Santa Rosa de Cabal', 26),
(890, 'Santuario', 26),
(891, 'San Andres', 27),
(892, 'Aguada', 28),
(893, 'Albania', 28),
(894, 'Aratoca', 28),
(895, 'Barbosa', 28),
(896, 'Barichara', 28),
(897, 'Barrancabermeja', 28),
(898, 'Betulia', 28),
(899, 'Bolívar', 28),
(900, 'Bucaramanga', 28),
(901, 'Cabrera', 28),
(902, 'California', 28),
(903, 'Capitanejo', 28),
(904, 'Carcasi', 28),
(905, 'Cepita', 28),
(906, 'Cerrito', 28),
(907, 'Charalá', 28),
(908, 'Charta', 28),
(909, 'Chima', 28),
(910, 'Chipatá', 28),
(911, 'Cimitarra', 28),
(912, 'Concepción', 28),
(913, 'Confines', 28),
(914, 'Contratación', 28),
(915, 'Coromoro', 28),
(916, 'Curití', 28),
(917, 'El Carmen', 28),
(918, 'El Guacamayo', 28),
(919, 'El Peñón', 28),
(920, 'El Playón', 28),
(921, 'Encino', 28),
(922, 'Enciso', 28),
(923, 'Florián', 28),
(924, 'Floridablanca', 28),
(925, 'Galán', 28),
(926, 'Gambita', 28),
(927, 'Girón', 28),
(928, 'Guaca', 28),
(929, 'Guadalupe', 28),
(930, 'Guapota', 28),
(931, 'Guavatá', 28),
(932, 'Guepsa', 28),
(933, 'Hato', 28),
(934, 'Jesús Maria', 28),
(935, 'Jordán', 28),
(936, 'La Belleza', 28),
(937, 'Landazuri', 28),
(938, 'La Paz', 28),
(939, 'Lebrija', 28),
(940, 'Los Santos', 28),
(941, 'Macaravita', 28),
(942, 'Málaga', 28),
(943, 'Matanza', 28),
(944, 'Mogotes', 28),
(945, 'Molagavita', 28),
(946, 'Ocamonte', 28),
(947, 'Oiba', 28),
(948, 'Onzaga', 28),
(949, 'Palmar', 28),
(950, 'Palmas del Socorro', 28),
(951, 'Páramo', 28),
(952, 'Piedecuesta', 28),
(953, 'Pinchote', 28),
(954, 'Puente Nacional', 28),
(955, 'Puerto Parra', 28),
(956, 'Puerto Wilches', 28),
(957, 'Rionegro', 28),
(958, 'Sabana de Torres', 28),
(959, 'San Andrés', 28),
(960, 'San Benito', 28),
(961, 'San Gil', 28),
(962, 'San Joaquín', 28),
(963, 'San José de Miranda', 28),
(964, 'San Miguel', 28),
(965, 'San Vicente de Chucurí', 28),
(966, 'Santa Bárbara', 28),
(967, 'Santa Helena', 28),
(968, 'Simacota', 28),
(969, 'Socorro', 28),
(970, 'Suaita', 28),
(971, 'Sucre', 28),
(972, 'Surata', 28),
(973, 'Tona', 28),
(974, 'Valle San José', 28),
(975, 'Vélez', 28),
(976, 'Vetas', 28),
(977, 'Villanueva', 28),
(978, 'Zapatoca', 28),
(979, 'Buenavista', 29),
(980, 'Caimito', 29),
(981, 'Coloso', 29),
(982, 'Corozal', 29),
(983, 'Chalán', 29),
(984, 'Coveñas', 29),
(985, 'El Roble', 29),
(986, 'Galeras', 29),
(987, 'Guaranda', 29),
(988, 'La Unión', 29),
(989, 'Los Palmitos', 29),
(990, 'Majagual', 29),
(991, 'Morroa', 29),
(992, 'Ovejas', 29),
(993, 'Palmito', 29),
(994, 'Sampues', 29),
(995, 'San Benito Abad', 29),
(996, 'San Juan De Betulia', 29),
(997, 'San Marcos', 29),
(998, 'San Onofre', 29),
(999, 'San Pedro', 29),
(1000, 'Sincé', 29),
(1001, 'Sincelejo', 29),
(1002, 'Sucre', 29),
(1003, 'Tolú', 29),
(1004, 'Toluviejo', 29),
(1005, 'Alpujarra', 30),
(1006, 'Alvarado', 30),
(1007, 'Ambalema', 30),
(1008, 'Anzoategui', 30),
(1009, 'Armero (Guayabal)', 30),
(1010, 'Ataco', 30),
(1011, 'Cajamarca', 30),
(1012, 'Carmen de Apicalá', 30),
(1013, 'Casabianca', 30),
(1014, 'Chaparral', 30),
(1015, 'Coello', 30),
(1016, 'Coyaima', 30),
(1017, 'Cunday', 30),
(1018, 'Dolores', 30),
(1019, 'Espinal', 30),
(1020, 'Falán', 30),
(1021, 'Flandes', 30),
(1022, 'Fresno', 30),
(1023, 'Guamo', 30),
(1024, 'Herveo', 30),
(1025, 'Honda', 30),
(1026, 'Ibagué', 30),
(1027, 'Icononzo', 30),
(1028, 'Lérida', 30),
(1029, 'Líbano', 30),
(1030, 'Mariquita', 30),
(1031, 'Melgar', 30),
(1032, 'Murillo', 30),
(1033, 'Natagaima', 30),
(1034, 'Ortega', 30),
(1035, 'Palocabildo', 30),
(1036, 'Piedras', 30),
(1037, 'Planadas', 30),
(1038, 'Prado', 30),
(1039, 'Purificación', 30),
(1040, 'Rioblanco', 30),
(1041, 'Roncesvalles', 30),
(1042, 'Rovira', 30),
(1043, 'Saldaña', 30),
(1044, 'San Antonio', 30),
(1045, 'San Luis', 30),
(1046, 'Santa Isabel', 30),
(1047, 'Suárez', 30),
(1048, 'Valle de San Juan', 30),
(1049, 'Venadillo', 30),
(1050, 'Villahermosa', 30),
(1051, 'Villarrica', 30),
(1052, 'Alcalá', 31),
(1053, 'Andalucía', 31),
(1054, 'Ansermanuevo', 31),
(1055, 'Argelia', 31),
(1056, 'Bolívar', 31),
(1057, 'Buenaventura', 31),
(1058, 'Buga', 31),
(1059, 'Bugalagrande', 31),
(1060, 'Caicedonia', 31),
(1061, 'Cali', 31),
(1062, 'Candelaria', 31),
(1063, 'Cartago', 31),
(1064, 'Dagua', 31),
(1065, 'Darién', 31),
(1066, 'El Aguila', 31),
(1067, 'El Cairo', 31),
(1068, 'El Cerrito', 31),
(1069, 'El Dovio', 31),
(1070, 'Florida', 31),
(1071, 'Ginebra', 31),
(1072, 'Guacarí', 31),
(1073, 'Jamundí', 31),
(1074, 'La Cumbre', 31),
(1075, 'La Unión', 31),
(1076, 'La Victoria', 31),
(1077, 'Obando', 31),
(1078, 'Palmira', 31),
(1079, 'Pradera', 31),
(1080, 'Restrepo', 31),
(1081, 'Riofrío', 31),
(1082, 'Roldanillo', 31),
(1083, 'San Pedro', 31),
(1084, 'Sevilla', 31),
(1085, ' Toro', 31),
(1086, 'Trujillo', 31),
(1087, 'Tuluá', 31),
(1088, 'Ulloa', 31),
(1089, 'Versalles', 31),
(1090, 'Vijes', 31),
(1091, 'Yotoco', 31),
(1092, 'Yumbo', 31),
(1093, 'Zarzal', 31),
(1094, 'Carurú', 32),
(1095, 'Mitú', 32),
(1096, 'Taraira', 32),
(1097, 'Cumaribo', 33),
(1098, 'La Primavera', 33),
(1099, 'Puerto Carreño', 33),
(1100, 'Santa Rosalía', 33);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta_p`
--

CREATE TABLE `pregunta_p` (
  `pkID` int(11) NOT NULL,
  `pregunta` text NOT NULL,
  `fkID_prueba` int(11) NOT NULL,
  `fkID_tipo_pregunta_p` int(11) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta_p_respuesta_p`
--

CREATE TABLE `pregunta_p_respuesta_p` (
  `pkID` int(11) NOT NULL,
  `fkID_pregunta_p` int(11) NOT NULL,
  `fkID_respuesta_p` int(11) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_marco`
--

CREATE TABLE `proyecto_marco` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `operador` text NOT NULL,
  `valor` bigint(11) NOT NULL,
  `fuente_recursos` varchar(250) NOT NULL,
  `financiadores` varchar(250) NOT NULL,
  `gerente` varchar(250) NOT NULL,
  `lugar_ejecucion` varchar(250) NOT NULL,
  `interventoria` varchar(250) NOT NULL,
  `supervisor` varchar(250) NOT NULL
);

--
-- Volcado de datos para la tabla `proyecto_marco`
--

INSERT INTO `proyecto_marco` (`pkID`, `nombre`, `fecha_ini`, `fecha_fin`, `operador`, `valor`, `fuente_recursos`, `financiadores`, `gerente`, `lugar_ejecucion`, `interventoria`, `supervisor`) VALUES
(1, 'Ondas', '2016-11-12', '2020-11-12', 'Operador1', 200000000, 'Fr1', 'financiador1', 'Jorge Silva', 'Guainia', 'Interv1', 'Superviso1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prueba`
--

CREATE TABLE `prueba` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `url_archivo` varchar(250) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta_p`
--

CREATE TABLE `respuesta_p` (
  `pkID` int(11) NOT NULL,
  `respuesta` text NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tematica`
--

CREATE TABLE `tematica` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_actor`
--

CREATE TABLE `tipo_actor` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_apropiacion_social`
--

CREATE TABLE `tipo_apropiacion_social` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL
) ;

--
-- Volcado de datos para la tabla `tipo_apropiacion_social`
--

INSERT INTO `tipo_apropiacion_social` (`pkID`, `nombre`) VALUES
(1, 'Reunión'),
(2, 'Evento Cultural');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_escuela`
--

CREATE TABLE `tipo_escuela` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL
) ;

--
-- Volcado de datos para la tabla `tipo_escuela`
--

INSERT INTO `tipo_escuela` (`pkID`, `nombre`) VALUES
(1, 'Tipo1'),
(2, 'Tipo2'),
(3, 'Tipi3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pregunta_p`
--

CREATE TABLE `tipo_pregunta_p` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL
) ;

--
-- Volcado de datos para la tabla `tipo_pregunta_p`
--

INSERT INTO `tipo_pregunta_p` (`pkID`, `nombre`) VALUES
(1, 'Abierta'),
(2, 'Unica'),
(3, 'Múltiple');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_sede`
--

CREATE TABLE `tipo_sede` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL
) ;

--
-- Volcado de datos para la tabla `tipo_sede`
--

INSERT INTO `tipo_sede` (`pkID`, `nombre`) VALUES
(1, 'Principal'),
(2, 'Sede');

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_vinculacion`
--

CREATE TABLE `tipo_vinculacion` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL
) ;

--
-- Volcado de datos para la tabla `tipo_vinculacion`
--

INSERT INTO `tipo_vinculacion` (`pkID`, `nombre`) VALUES
(1, 'Tipov1'),
(2, 'Tipov2');

-- --------------------------------------------------------


--
-- Estructura de tabla para la tabla `zona`
--

CREATE TABLE `zona` (
  `pkID` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL
) ;

--
-- Volcado de datos para la tabla `zona`
--

INSERT INTO `zona` (`pkID`, `nombre`) VALUES
(1, 'Rural'),
(2, 'Urbana');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `apropiacion_actor`
--
ALTER TABLE `apropiacion_actor`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `apropiacion_social`
--
ALTER TABLE `apropiacion_social`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `infraestructura`
--
ALTER TABLE `infraestructura`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `institucion_infraestructura`
--
ALTER TABLE `institucion_infraestructura`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `lugar_apropiacion`
--
ALTER TABLE `lugar_apropiacion`
  ADD PRIMARY KEY (`pkID`);


--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `pregunta_p`
--
ALTER TABLE `pregunta_p`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `pregunta_p_respuesta_p`
--
ALTER TABLE `pregunta_p_respuesta_p`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `proyecto_marco`
--
ALTER TABLE `proyecto_marco`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `prueba`
--
ALTER TABLE `prueba`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `respuesta_p`
--
ALTER TABLE `respuesta_p`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `tematica`
--
ALTER TABLE `tematica`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `tipo_actor`
--
ALTER TABLE `tipo_actor`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `tipo_apropiacion_social`
--
ALTER TABLE `tipo_apropiacion_social`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `tipo_escuela`
--
ALTER TABLE `tipo_escuela`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `tipo_pregunta_p`
--
ALTER TABLE `tipo_pregunta_p`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `tipo_sede`
--
ALTER TABLE `tipo_sede`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `tipo_vinculacion`
--
ALTER TABLE `tipo_vinculacion`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`pkID`);

--
-- Indices de la tabla `zona`
--
ALTER TABLE `zona`
  ADD PRIMARY KEY (`pkID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actor`
--
ALTER TABLE `actor`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `apropiacion_actor`
--
ALTER TABLE `apropiacion_actor`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `apropiacion_social`
--
ALTER TABLE `apropiacion_social`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `archivo`
--
ALTER TABLE `archivo`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `infraestructura`
--
ALTER TABLE `infraestructura`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `institucion_infraestructura`
--
ALTER TABLE `institucion_infraestructura`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `lugar_apropiacion`
--
ALTER TABLE `lugar_apropiacion`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
--
ALTER TABLE `municipio`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
--
ALTER TABLE `pregunta_p`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pregunta_p_respuesta_p`
--
ALTER TABLE `pregunta_p_respuesta_p`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `proyecto_marco`
--
ALTER TABLE `proyecto_marco`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `prueba`
--
ALTER TABLE `prueba`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `respuesta_p`
--
ALTER TABLE `respuesta_p`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tematica`
--
ALTER TABLE `tematica`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_actor`
--
ALTER TABLE `tipo_actor`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_apropiacion_social`
--
ALTER TABLE `tipo_apropiacion_social`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_escuela`
--
ALTER TABLE `tipo_escuela`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_pregunta_p`
--
ALTER TABLE `tipo_pregunta_p`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_sede`
--
ALTER TABLE `tipo_sede`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_vinculacion`
--
ALTER TABLE `tipo_vinculacion`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `zona`
--
ALTER TABLE `zona`
  MODIFY `pkID` int(11) NOT NULL AUTO_INCREMENT;