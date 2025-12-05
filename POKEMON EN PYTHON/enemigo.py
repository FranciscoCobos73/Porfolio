class Enemigo:
    def __init__(self, nombre):
        self.nombre = nombre
        self.lista_digimons = []
        self.cantidad_digipymon = 0
        
    def añadir_digipymon(self, digipymon):
        self.lista_digimons.append(digipymon)
        self.cantidad_digipymon += 1
    
    def __str__(self):
        return f"Entrenador Enemigo: {self.nombre} que tiene {self.cantidad_digipymon} digipymons"