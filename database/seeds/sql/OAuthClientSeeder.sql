INSERT INTO oauth_personal_access_clients (id, client_id, created_at, updated_at) VALUES
(1, 1, '2016-11-16 23:36:20', '2016-11-16 23:36:20');

INSERT INTO oauth_clients (id, user_id, name, secret, redirect, personal_access_client, password_client, revoked, created_at, updated_at) VALUES
(1, NULL, 'Laravel Personal Access Client', 'FVC2vGjpKCpUL0FWA2Muj61zxliXEPNlhe9nj503', 'http://localhost', 1, 0, 0, '2016-11-16 23:36:20', '2016-11-16 23:36:20'),
(2, NULL, 'Laravel Password Grant Client', 'EaNWQo6E4VgK2DqN8IMOeCapnzU2VOEhyI4McdGx', 'http://localhost', 0, 1, 0, '2016-11-16 23:36:20', '2016-11-16 23:36:20');