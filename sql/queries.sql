-- Pedidos em que user é dono
SELECT *
FROM pedido JOIN users_pedido ON (pedido.id = users_id)
WHERE users_id = $_ID AND users_pedido.owner = true


-- Inserir Pedido
INSERT INTO pedido
VALUES (DEFAULT, 'nome', 'recompensa', CURRENT_TIMESTAMP, 'descrição', 'local',  '2017-12-25')
RETURNING id

INSERT INTO users_pedido VALUES ($_ID, ?, 'true')


-- Inserir comentário
INSERT INTO comment VALUES (DEFAULT, commenter-id, commented-id, rating, 'boas amigo :--P', CURRENT_TIMESTAMP, pedido_id)
RETURNING id


-- Comentários feitos a um user, recentes
SELECT users.name, comment.id, commenter_id, commented_id, comment.classification, comment, time_posted, pedido_id
FROM users JOIN comment ON (users.id = commenter_id)
WHERE commented_id = $user_id
ORDER BY time_posted DESC
LIMIT $limit


-- Buscar pedido por ID
SELECT *
FROM pedido
WHERE id = $request_id


-- Buscar dono do pedido
SELECT *
FROM users_pedido JOIN users ON (users_id = id)
WHERE owner = true AND pedido_id = $request_id


-- Buscar descrição
SELECT description
FROM users
WHERE id = $_ID

-- Pedidos em que user está a ajudar
SELECT *
FROM pedido JOIN users_pedido ON (pedido.id = pedido_id)
WHERE users_id = $_ID AND users_pedido.owner = false
