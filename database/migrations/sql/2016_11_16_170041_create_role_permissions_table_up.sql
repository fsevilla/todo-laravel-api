CREATE TABLE IF NOT EXISTS role_permissions (
    user_type_id int(11) NOT NULL,
    resource_id int(11) NOT NULL,
    permission_id int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;