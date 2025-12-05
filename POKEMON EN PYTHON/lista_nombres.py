import random

class ListaNombres:
    def __init__(self):
        self.lista_nombres_digipymons = ["Pikachu", "Eternatus Eternamax", "Primal Groudon", "Primal Kyogre", "Mega Rayquaza", "Mega Garchomp", "Mega Tyranitar", "Mega Salamence", "Mega Latios", "Mega Heracross", "Mega Latias", "Palafin Hero", "Mega Gyarados", "Necrozma Ultra", "Kyurem Black", "Kyurem White", "Calyrex Shadow Rider", "Mega Gallade", "Mega Gardevoir", "Mega Alakazam"]
        self.lista_nombres_entrenadores = ["Ash", "Misty", "Brock", "Gary", "May", "Dawn", "Iris", "Cilan", "Serena", "Clemont", "Bonnie", "Kiawe", "Lillie", "Goh", "Chloe", "Tracey", "Paul", "Alain", "Gladion", "Rinto"]
        
    def obtener_nombre_digipymon(self):
        self.nombre_d = random.choice(self.lista_nombres_digipymons)
        return self.nombre_d
    
    def obtener_nombre_entrenador(self):
        self.nombre_e = random.choice(self.lista_nombres_entrenadores)
        return self.nombre_e
    
   