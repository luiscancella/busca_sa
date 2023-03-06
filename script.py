import pandas as pd
import pymysql

# Definindo informações do banco de dados
host = 'localhost'
user = 'root'
password = ''
db = 'thxavier'

# Conectando ao banco de dados
conn = pymysql.connect(host=host, user=user, password=password, db=db, port=3306)

# Lendo a planilha
planilha = pd.read_excel('arquivos/ThXavier.xlsx')

# Iterando sobre as linhas da planilha e inserindo os dados no banco de dados
for index, row in planilha.iterrows():
    nome_livro = row['Nome do livro']
    autor = row['Autor']
    categoria = row['Categoria']
    preco = row['Preço (em reais)']
    tipo_capa = row['Tipo de Capa']
    estoque = row['Estoque']
    editora = row['Editora']
    ano_publicacao = row['Ano de publicação']
    
    # Inserindo dados no banco de dados
    cursor = conn.cursor()
    query = "INSERT INTO livro (nome, autor, categoria, preco, tipo_capa, estoque, editora, ano_publicacao) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)"
    cursor.execute(query, (nome_livro, autor, categoria, preco, tipo_capa, estoque, editora, ano_publicacao))
    conn.commit()

# Fechando a conexão com o banco de dados
conn.close()