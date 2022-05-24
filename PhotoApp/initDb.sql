CREATE TABLE `images2` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`image_url` text NOT NULL,
	`image_date` text,
	`filters` text
	);

ALTER TABLE `images2`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `images2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;