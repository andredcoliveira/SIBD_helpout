-- Pedidos em que user é dono (substituir 1 pelo id)

SELECT *
FROM users JOIN users_pedido ON (users.id = users_id)
WHERE users.id = 1



-- Pedidos em que user está a ajudar



-- Inserir Pedido

INSERT INTO pedido
VALUES (DEFAULT, 'nome', 'recompensa', CURRENT_TIMESTAMP, 'descrição', 'local',  '2017-12-25')
RETURNING id

INSERT INTO users_pedido VALUES ($_ID, ?, 'true')



-- Buscar pedido por ID (a partir do $_GET que traz ID do URL)
