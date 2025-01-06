CREATE TABLE `user`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_image` BIGINT NOT NULL,
    `username` BIGINT NOT NULL,
    `user_password` VARCHAR(255) NOT NULL,
    `user_mail` VARCHAR(255) NOT NULL,
    `profile_desc` VARCHAR(255) NOT NULL,
    `role` VARCHAR(255) NOT NULL DEFAULT 'user'
);
ALTER TABLE
    `user` ADD UNIQUE `user_username_unique`(`username`);
CREATE TABLE `user_details`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_user` BIGINT NOT NULL,
    `address` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(255) NOT NULL,
    `country` VARCHAR(255) NOT NULL,
    `firstName` VARCHAR(255) NOT NULL,
    `lastName` VARCHAR(255) NOT NULL
);
CREATE TABLE `annonce`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_user` BIGINT NOT NULL,
    `id_product` BIGINT NOT NULL,
    `price` BIGINT NOT NULL,
    `condition` ENUM(
        'New',
        'Like_New',
        'Good',
        'Acceptable',
        'Damaged'
    ) NULL
);
CREATE TABLE `professional_details`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_user` BIGINT NOT NULL,
    `company_name` VARCHAR(255) NOT NULL,
    `company_address` VARCHAR(255) NOT NULL,
    `company_phone` VARCHAR(255) NOT NULL
);
CREATE TABLE `image`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `img_path` VARCHAR(255) NOT NULL
);
CREATE TABLE `user_transactions`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_annonce` BIGINT NOT NULL,
    `id_user` BIGINT NOT NULL,
    `transactionAt` DATETIME NOT NULL,
    `status` VARCHAR(255) NOT NULL
);
CREATE TABLE `type`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `type_name` BIGINT NOT NULL
);
CREATE TABLE `product`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_image` BIGINT NOT NULL,
    `id_type` BIGINT NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `id_author` BIGINT NULL,
    `specifications` VARCHAR(255) NULL
);
CREATE TABLE `genre`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL
);
CREATE TABLE `product_genre`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_genre` BIGINT NOT NULL,
    `id_product` BIGINT NOT NULL
);
CREATE TABLE `author`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `biography` VARCHAR(255) NOT NULL
);
CREATE TABLE `image_annonce`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_image` BIGINT NOT NULL,
    `id_annonce` BIGINT NOT NULL
);
ALTER TABLE
    `annonce` ADD CONSTRAINT `annonce_id_product_foreign` FOREIGN KEY(`id_product`) REFERENCES `product`(`id`);
ALTER TABLE
    `product_genre` ADD CONSTRAINT `product_genre_id_genre_foreign` FOREIGN KEY(`id_genre`) REFERENCES `genre`(`id`);
ALTER TABLE
    `image_annonce` ADD CONSTRAINT `image_annonce_id_annonce_foreign` FOREIGN KEY(`id_annonce`) REFERENCES `annonce`(`id`);
ALTER TABLE
    `user_transactions` ADD CONSTRAINT `user_transactions_id_annonce_foreign` FOREIGN KEY(`id_annonce`) REFERENCES `annonce`(`id`);
ALTER TABLE
    `user` ADD CONSTRAINT `user_id_image_foreign` FOREIGN KEY(`id_image`) REFERENCES `image`(`id`);
ALTER TABLE
    `image_annonce` ADD CONSTRAINT `image_annonce_id_image_foreign` FOREIGN KEY(`id_image`) REFERENCES `image`(`id`);
ALTER TABLE
    `professional_details` ADD CONSTRAINT `professional_details_id_user_foreign` FOREIGN KEY(`id_user`) REFERENCES `user`(`id`);
ALTER TABLE
    `product` ADD CONSTRAINT `product_id_type_foreign` FOREIGN KEY(`id_type`) REFERENCES `type`(`id`);
ALTER TABLE
    `user_details` ADD CONSTRAINT `user_details_id_user_foreign` FOREIGN KEY(`id_user`) REFERENCES `user`(`id`);
ALTER TABLE
    `product` ADD CONSTRAINT `product_id_image_foreign` FOREIGN KEY(`id_image`) REFERENCES `image`(`id`);
ALTER TABLE
    `product` ADD CONSTRAINT `product_id_author_foreign` FOREIGN KEY(`id_author`) REFERENCES `author`(`id`);
ALTER TABLE
    `annonce` ADD CONSTRAINT `annonce_id_user_foreign` FOREIGN KEY(`id_user`) REFERENCES `user`(`id`);
ALTER TABLE
    `user_transactions` ADD CONSTRAINT `user_transactions_id_user_foreign` FOREIGN KEY(`id_user`) REFERENCES `user`(`id`);
ALTER TABLE
    `product_genre` ADD CONSTRAINT `product_genre_id_product_foreign` FOREIGN KEY(`id_product`) REFERENCES `product`(`id`);