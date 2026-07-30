INSERT INTO notification_templates 
(title, content, description, phone_number, type, deleted_at, created_at, updated_at) 
VALUES
    ('Aprovado na Disciplina',
     'Para continuar o curso Faça o Pagamento',
     'Cobrança depois de duas disciplinas finalizadas.',
     '5522998973216',
     'discipline_notification',
     NULL,
     NOW(),
     NULL),
     
    ('Aprovado no Curso',
     'nr-35-trabalho-em-altura',
     'Curso finalizado com sucesso.',
     '5522998973216',
     'course_notification',
     NULL,
     NOW(),
     NULL);
