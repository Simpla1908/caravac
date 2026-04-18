# import mysql.connector

# # Connexion à la base
# conn = mysql.connector.connect(
#     host="localhost",
#     user="root",
#     password="E1b2u3t4e5l6o@",
#     database="caravacdb"
# )

# cursor = conn.cursor()

# # Données volailles
# volailles = [
#         {"nom": "PANCAKE CREME CHEESE SPECULOOS", "prix": 21000},
#         {"nom": "PANCAKE CREME CHEESE OREO", "prix": 21000},
#         {"nom": "PANCAKE AUX FRUITS", "prix": 33500}
# ]

# # Paramètres fixes
# monnaie = "CDF"
# hotel_id = 356
# sousresto_id = 123
# famille_id = 51 # IMPORTANT : famille volailles

# for item in volailles:

#     designation = item["nom"]
#     prix = item["prix"]

#     # 1. INSERT produit
#     insert_produit = """
#     INSERT INTO stk_produit (
#         code, designation, path_image, qte_min, qte_initial, qte_dispo,
#         pa, pv, tva, monnaie, repas, statut, pseudo_supp, unite,
#         ingredient, famille_id, nourriture, hotel_id, vendrerupturestk, syn
#     ) VALUES (
#         %s, %s, NULL, 0, 0, 0,
#         0.00, 0.00, 0.0, %s, 1, 0, 0, 'unite',
#         0, %s, 1, %s, 0, 0
#     )
#     """

#     # code simple (tu peux améliorer après)
#     code = designation.replace(" ", "")[:10]

#     cursor.execute(insert_produit, (code, designation, monnaie, famille_id, hotel_id))

#     # récupérer l'id du produit
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

# print("✅ Import volailles terminé !")

# # Fermeture
# cursor.close()
# conn.close()