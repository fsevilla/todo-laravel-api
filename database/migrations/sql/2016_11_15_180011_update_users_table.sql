ALTER TABLE users 
    ADD user_type_id INT NOT NULL DEFAULT '4' AFTER remember_token,
    ADD status INT NOT NULL DEFAULT '2' AFTER user_type_id;