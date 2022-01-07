CREATE DATABASE iv;
use iv;
CREATE TABLE IF NOT EXISTS `contas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `user` VARCHAR(45) NOT NULL,
  `pass` VARCHAR(45) NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

INSERT INTO contas VALUES
(default, 'carlosribeiroeduardo12@gmail.com','Carlos',md5('carlos'),'Carlos Eduardo Ribeiro dos Santos'),
(default, 'igorvinicius@gmail.com','Igor',md5('igor'),'Igor Vinicicius');
select * from contas;

create table genero(
codigo int not null auto_increment,
genero varchar(45),
 PRIMARY KEY (codigo)
 );
INSERT INTO genero VALUES
(default,'Macho'),
(default,'Femea');

CREATE TABLE marca (
  codigo INT NOT NULL AUTO_INCREMENT,
  dataContagem DATE NOT NULL,
  dataNasc DATE NOT NULL,
  numeroBrinco INT NOT NULL,
  genero INT(11) NOT NULL,
  conta INT(11) NOT NULL,
  vendido  INT(11) default 0,
  valorArroba INT NOT NULL,
  pesoKG DOUBLE NOT NULL,
  PRIMARY KEY (codigo),
  foreign key (conta) references contas(id),
  foreign key (genero) references genero(codigo)
  );
INSERT INTO marca (dataContagem, dataNasc, numeroBrinco, genero,conta, valorArroba, pesoKG) 
VALUES ( '2020-02-27', '2020-02-27', '698363', '1','1','150', '850'),
( '2020-03-28', '2020-03-28','754623','1','2', '150', '456'),
( '2020-04-29', '2020-04-29','346709','1','1', '150', '720'),
('2020-11-05', '2020-11-05','567645','1','2', '150', '498');

create table vacina(
codigo int auto_increment not null,
obrigatorio varchar(1),
nome varchar(100) not null,
descricao varchar(300) not null,
dosagem varchar(300) not null,
administracao varchar(300) NOT NULL,
classe varchar(100) NOT NULL,
primary key(codigo)
);
insert into vacina(codigo, nome, descricao, dosagem, administracao, classe) value
('1', 'AFTOBOV® OLEOSA', 'Vacina trivalente, contendo vírus "O", "A" e "C", purificada, inativada, oleosa, de maior duração de imunidade contra a febre aftosa.', 'Aplicar a dose de 5 mL para bovinos por via subcutânea ou intramuscular na região da "tábua do pescoço".', 'Aplicar a dose de 5 mL para bovinos por via subcutânea ou intramuscular na região da "tábua do pescoço". A primovacinação deve ser efetuada até os 4 meses de idade, revacinando os animais 1 a 3 meses após a primeira dose. Daí em diante, inicia-se o programa recomendado para todas as categorias animais: vacinação a cada 6 meses. A critério das autoridades sanitárias e, sob responsabilidade destas, outros esquemas de vacinação poderão ser adotados.', 'Vacinas, Corantes e Diluentes'),
('2', 'Aftogen Óleo', 'Imunização de bovinos e bubalinos contra a Febre Aftosa.', '5 ml em bovinos e bubalinos', 'Via intramuscular ou subcutânea, na tábua do pescoço. O esquema de vacinação deve seguir o programa sanitário oficial.', 'Vacinas, Corantes e Diluentes'),
('3', 'BIO-AFTO-VET', 'Prevenção da Febre Aftosa dos bovinos e bubalinos.', '1ª dose: até 4 meses de idade | 2ª dose: 3 meses após 1ª dose', 'Revacinar a cada 6 meses. A dose deve ser de 5 mL por via subcutânea ou intramuscular, na região da tábua do pescoço (terço médio).', 'Vacinas, Corantes e Diluentes'),
('4', 'BGS-CELL', 'Prevenção da raiva dos herbívoros.', 'Aplicar por via subcutânea ou intramuscular a dose de 2mL para bovinos , equinos, ovinos e caprinos a partir de 3 meses de idade com revacinação após 30 dias. A imunidade é obtida 21 dias após a segunda dose. Revacinar os animais com uma única dose da vacina a cada 12 mese, pois esta é a duração da imunidade. A vacinação de bovídeos e equideos com idade inferior a 3 meses poderá ser realizada a critério do Médio-Veterinário.', 'Via subcutânea ou intramuscular. A vacina não deve ficar fora do gelo ou exposta diretamente a luz solar.', 'Vacinas, Corantes e Diluentes'),
('5', 'Bioabortogen H', 'Prevenção das enfermidades que provocam infertilidade e abortos em bovinos', '5 ml', 'Via subcutânea.', 'Vacinas, Corantes e Diluentes'),
('6', 'AcurA®', 'AcurA® é um antimicrobiano em dose única indicado para o tratamento de doenças infecciosas que acometem bovinos, equinos e caninos, causadas por bactérias sensíveis ao ceftiofur.', 'Aplicar dose única de 1 mL para cada 20 kg de peso vivo, dose equivalente a 3,15 mg de ceftiofur (cloridrato) por Kg de peso vivo.', 'ACURA deve ser aplicado exclusivamente pela via intramuscular com o auxílio de equipamento apropriado, estéril, acoplado a agulhas de tamanho 1,2 X 40mm para bovinos/equinos jovens e cães ou 1,6 X 40mm para bovinos/equinos adultos.', 'Antimicrobianos Gerais, Antifúngicos e Antiprotozoários'),
('7', 'ISOCOX OUROFINO SAÚDE ANIMAL LTDA.', 'É um agente anticoccidiano para bovinos. ISOCOX atua em todas as fases de desenvolvimento do parasita e é indicado para profilaxia e tratamento da coccidiose. A coccidiose bovina e ovina acomete principalmente animais jovens, também apresentando alterações gastrintestinais e quadros variáveis de diarreia.', ' Deve ser administrado em bovinos na dosagem de 3 mL/10 kg de peso vivo (equivalente à 15 mg/kg de toltrazuril) pela via oral em dose única. Em ovinos, administrar na dosagem de 1 mL/25 kg de peso vivo (equivalente à 20 mg/kg de toltrazuril) pela via oral em dose única.', 'ISOCOX deve ser administrado pela via oral. Agitar bem o frasco antes de usar.', 'Antimicrobianos Gerais, Antifúngicos e Antiprotozoários'),
('8', 'ABUTOR MATABICHEIRAS SPRAY', 'Como preventivo: de bicheiras e infecções bacterianas em castração, descorna, descola, marcação, cortes de tosquia, lesões acidentais, em umbigo de recém-nascidos. Em lesões provocadas por: Manqueira, Foot-rot, bernes, carrapatos e Aftosa (lesões dos cascos). COMO CURATIVO: em bicheiras (miíases).', '-', '- Retirar a tampa protetora e agitar o tubo. - Apertar a parte superior da válvula, aplicando o produto na região afetada, NÃO ABUSE, pois pode intoxicar o animal caso o mesmo lamba o local. Se necessário, repetir o tratamento 7 a 9 dias depois', 'Antimicrobianos Gerais, Antifúngicos e Antiprotozoários'),
('9', 'ADE TETRAMISOL com prometazina', 'No tratamento e controle das infestações - vermes gastrintestinais e pulmonares (Dictyocaulus e Metastrongylus) em bovinos.', 'Bovinos: 1 ml para cada 20 kg de peso (5 mg/Kg): dose máxima - 15 ml', 'Deve ser usada por via intramuscular ou subcutânea. Agite antes de usar.', 'Antimicrobianos Gerais, Antifúngicos e Antiprotozoários'),
('10', 'ADVOCIN® SOLUÇÃO INJETÁVEL', 'Animais tratados com Advocin® Solução Injetável são rapidamente recuperados. A febre se reduz em pouco tempo e os sinais clínicos da doença desaparecem rapidamente.', 'Administrar dose de 1 mL para 20 kg de peso corporal (1,25 mg/kg). Para o tratamento de animais pesando mais de 400 kg, dividir as aplicações, não injetando mais de 20 mL no mesmo local. Fazer aplicações com intervalo de 24 horas durante três dias seguidos. Em casos mais graves, o tratamento pode ser continuado por mais dois dias. ', 'Advocin® Solução Injetável a 2,5% deve ser aplicado, em bovinos, por via intramuscular, intravenosa ou subcutânea.', 'Antimicrobianos Gerais, Antifúngicos e Antiprotozoários'),
('11', 'ANESTÉSICO BRAVET', 'O Anestésico Bravet é indicado em todos os casos em que se deseja inibir a dor de uma região do organismo para realização de intervenções cirúrgicas ou tratamento a critério do Médico Veterinário.', ' O Anestésico Bravet é um produto pronto para aplicação parenteral, para uso por: Aplicação superficial | Infiltração intradérmica ou subcutânea | Bloqueio espinhal', 'As doses recomendadas são: Anestesia paravertebral em bovinos: aproximadamente 7 mL, por cada ponto de origem do nervo | Descornas: 5 mL da solução para cada nervo corneal | Mochação: 2 mL da solução para cada nervo.', 'Anéstesicos, Sedativos e similares'),
('12', 'ACEPRAN 1%', 'Particularmente indicado como auxiliar no controle de animais de médio e grande porte durante os exames, tratamento, embarques e transportes. Bastante eficaz quando empregado em conjunto com anestesia local nas castrações, neurectomias, “pontas de fogo”, remoção de tumores da pele e cirurgias oculares.', 'Pode ser utilizado por via intravenosa, intramuscular ou subcutânea. A dose deve ser estabelecida individualmente, dependendo do grau de tranquilização requerido. Animais de grande porte: 0,5 mL a 1,0 mL/100 Kg de peso. Animais de médio porte: Leitões: 0,2 – 0,3 mL/10 Kg de peso vivo. Suínos adultos: 2 mL/100 Kg de peso vivo. A administração deve ser feita por via intramuscular profunda', 'Uso injetável.', 'Anéstesicos, Sedativos e similares'),
('13', 'ANESTÉSICO VANSIL', 'Usado em casos no qual é desejável inibir a dor em uma determinada região, para realização de tratamentos dolorosos e intervenções clínico-cirúrgicas.', 'Animais de grande porte (Bovinos e equino adultos) 5,0 - 10,0 mL | Bezerros: 2,5 - 5,0 mL', 'Anestésico Vansil deve ser administrado através de injeções subcutâneas, infiltrações perimetral e epidural, assepticamente.', 'Anéstesicos, Sedativos e similares'),
('14', 'ABAMECTINA', 'É um endectocida de largo espectro de ação indicado para bovinos no tratamento e controle de vermes gastrointestinais e pulmonares, piolhos, bernes, ácaros e agentes da sarna auxilia no controle de carrapatos, na prevenção de bicheiras e nas feridas de castração em bovinos acima de 4 meses.', 'Aplicar 1mL para cada 50kg de peso corpóreo conforme a tabela vide bula. Animais com mais de 600kg, manter a mesma dosagem de 1mL para cada 50kg de peso corpóreo.', 'Administrar por via subcutânea.', 'Endectocidas (Anti-Parasitários)'),
('15', 'ABA LA', 'ABAMECTINA 1% OURO FINO LA é um endectocida avançado, de amplo espectro, de ação prolongada para bovinos, que combate os nematódeos gastrintestinais e pulmonares. É bernicida, sarnicida e carrapaticida.', '1 ml para cada 50 kg de peso corporal', 'Aplicar somente pela via subcutânea. Não tratar bezerros com menos de 16 semanas de idade.', 'Endectocidas (Anti-Parasitários)'),
('16', 'ABAFORT', 'Eficaz no tratamento e controle de nematóides gastrintestinais, nematóides pulmonares e ectoparasitas de bovinos. Possui amplo espectro, ampla margem de segurança, com baixa dosagem e boa tolerância', 'ABAFORT deve ser administrado na dose de 1 ml para cada 50 kg de peso corporal, equivalente a 200 mcg de Abamectina/kg de peso. Pode ser administrado de forma simultânea com outros produtos injetáveis tais como a vacina contra Clostridiose, Brucelose, etc.', 'ABAFORT deve ser aplicado em injeções subcutâneas, de preferência na região anterior ou posterior da escápula (paleta). Utilizar sempre agulhas e seringas estéreis. Desinfetar o local de aplicação com algodão embebido em álcool iodado ou semelhante.', 'Endectocidas (Anti-Parasitários)'),
('17', 'ABAGARD', 'Controle e Tratamento de: Vermes gastrointestinais, Vermes pulmonares, Piolhos, Ácaros e Carrapatos', 'Dose terapêutica / animal: 200mcg de abamectina / kg de peso corporal, ou seja 1 ml de produto para cada 50kg de peso corporal. Atenção: para animais mais pesados, seguir a dose padrão de 1ml/ 50kg de peso corporal.', 'Injetável, por via subcutânea, sob a pele solta na frente ou atrás da escápula.', 'Endectocidas (Anti-Parasitários)');
select * from vacina;
