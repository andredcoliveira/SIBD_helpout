-- Pedidos em que user é dono

SELECT *
FROM users JOIN users_pedido ON (users.id = users_id)


-- Pedidos em que user está a ajudar


-- Inserir Pedido

INSERT INTO pedido
VALUES (DEFAULT, 'nome', 'recompensa', CURRENT_TIMESTAMP, 'descrição', 'local',  '2017-12-25')
RETURNING id

INSERT INTO users_pedido VALUES ($_ID, ?, 'true')
