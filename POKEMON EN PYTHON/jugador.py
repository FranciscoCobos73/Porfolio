class Jugador:
     
    def __init__(self, nombre) :
      self.nombre = nombre
      self.lista_digipymon = []
      self.cantidad_digipymon = 0
      self.digicoins = 10
    
    def _str_(self):
       return f"Nombre: {self.nombre}, lista_digipymon: {self.lista_digipymon}, cantidad_digipymon: {self.cantidad_digipymon}, digicoins: { self.digicoins}"

    def añadir_digipymon(self, digipymon):
        self.lista_digipymon.append(digipymon)
        self.cantidad_digipymon = self.cantidad_digipymon + 1

    def consultar_digipymon(self):
      if self.cantidad_digipymon > 0:
            print("Estos son tus digipymons: ")
            for i in self.lista_digipymon:
             print(i)
      else:
         print("No hay ningun Digipymon en tu pokedex.")

    def consultar_digicoins(self):
       print(f"Tienes: {self.digicoins}, digicoins")
    
   
      
       
   


    
