CREATE TABLE compromisso (
    id          INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    descricao   VARCHAR(50) NOT NULL,
    data        DATE NOT NULL,
    hora        TIME NOT NULL,
    status      CHAR(1) NOT NULL DEFAULT 'A', -- Agendado, Cancelado, Realizado
    CONSTRAINT chk_status CHECK (status IN ('A', 'C', 'R'))
) ENGINE = INNODB;


INSERT INTO compromisso ( descricao, data, hora, status ) VALUES 
( 'Consulta médica', '2026-12-08', '11:00', 'A' ),
( 'Consulta odontológica', '2026-10-08', '15:00', 'A' ),
( 'Consulta veterinária', '2026-10-08', '17:00', 'C' ),
( 'Consulta psicológica', '2026-10-08', '19:00', 'R' ),
( 'Reunião com grupo', '2026-10-07', '13:00', 'R' ),
( 'Reunião com cliente', '2026-10-06', '14:00', 'C' ),
( 'Reunião com equipe', '2026-10-05', '16:00', 'A' ),
( 'Prova de Inglês', '2026-10-05', '19:00', 'C' ),
('Casamento', '2026-10-05', '20:00', 'R'),
('Aniversário', '2026-10-05', '21:00', 'A');