ALTER TABLE `valores_meta` ADD `script_m` TEXT NOT NULL AFTER `fecha_fin`;

ALTER TABLE `valores_meta` CHANGE `script_m` `script` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;