# import mysql.connector

# # Connexion à la base
# conn = mysql.connector.connect(
#     host="localhost",
#     user="root",
#     password="E1b2u3t4e5l6o@",
#     database="caravacdb"
# )

# cursor = conn.cursor()

# # Données champagnes
# champagnes = [
#     {"nom": "LEFFE BRUNE", "prix": 12000},
#     {"nom": "LEFFE BLONDE", "prix": 12000},
#     {"nom": "SAVANNA", "prix": 8000},
#     {"nom": "HEINEKEN", "prix": 12000},
#     {"nom": "BAVARIA MALT", "prix": 8000},
#     {"nom": "BAVARIA POMME", "prix": 8000},
#     {"nom": "RED BULL", "prix": 9000}
# ]

# # Paramètres fixes
# monnaie = "CDF"
# hotel_id = 356
# sousresto_id = 123
# famille_id = 70 # famille boissons / champagnes

# for item in champagnes:

#     designation = item["nom"]
#     prix = item["prix"]

#     # 1. INSERT produit (adapté à ton SQL)
#     insert_produit = """
#     INSERT INTO stk_produit (
#         code, designation, path_image, qte_min, qte_initial, qte_dispo,
#         pa, pv, tva, monnaie, repas, statut, pseudo_supp, unite,
#         ingredient, famille_id, nourriture, accomp, softplt, softbtl,
#         legume, cuisso, soce, cond, vin, biere, pop,
#         hotel_id, vendrerupturestk, syn
#     ) VALUES (
#         %s, %s, NULL, 0, 0, 0,
#         0.00, 0.00, 0.0, %s, 0, 0, 0, 'piece',
#         0, %s, 0, 0, 0, 0,
#         0, 0, 0, 0, 0, 0, 0,
#         %s, 0, 0
#     )
#     """

#     # code unique simple
#     code = designation.replace(" ", "")[:10]

#     cursor.execute(insert_produit, (code, designation, monnaie, famille_id, hotel_id))

#     # récupérer ID produit
#     produit_id = cursor.lastrowid

#     # 2. INSERT prix
#     insert_prix = """
#     INSERT INTO t_prix_produit (
#         prix_vente, monnaie, produit_id, sousresto_id, syn
#     ) VALUES (%s, %s, %s, %s, 0)
#     """

#     cursor.execute(insert_prix, (prix, monnaie, produit_id, sousresto_id))


# # Commit
# conn.commit()

# print("✅ Import champagnes terminé !")

# # Fermeture
# cursor.close()
# conn.close()