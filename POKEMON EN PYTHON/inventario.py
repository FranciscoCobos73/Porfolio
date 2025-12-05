class Inventario:
    def __init__(self):
        self.objetos = {}

    def añadir_objeto(self,nombre,cantidad):
        if nombre in self.objetos:
            self.objetos[nombre] += cantidad
            print(f"Ahora tienes {cantidad}  {nombre} +")
        else:
            self.objetos[nombre] = cantidad
            print(f" Se ha añadido {nombre} a tu inventario.")

    
    def usar_objeto(self, nombre):
        if nombre in self.objetos:
            self.objetos[nombre] -= 1
            print(f"Acabas de usar {nombre}. ")
            if self.objetos[nombre] <= 0:
                del self.objetos[nombre]
                print(f" Se te han terminado la {nombre}  y se ha eliminado del inventario.")
        else:
            print(f"No te quedan {nombre} en tu inventario.")

    def consultar_inventario(self):
        print("Este es tu inventario: ")
        for nombre, cantidad in self.objetos.items():
            print(f"{nombre}: {cantidad}")


