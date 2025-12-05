import random
from digipymon import Digipymon
from enemigo import Enemigo
from inventario import Inventario
from jugador import Jugador
from lista_nombres import ListaNombres



def generar_digipymon_aleatorio():
    tipo = random.choice(["Fuego", "Agua", "Planta"])
    vida = random.randint(10, 20)
    ataque = random.randint(1, 10)
    nivel = random.randint(1, 3)
    Nombres = ListaNombres()
    nombre = Nombres.obtener_nombre_digipymon()
    digipymon = Digipymon(nombre, vida, ataque, tipo, nivel)
    return digipymon
    
def menu():
   
    print("""
    ╔═══════════════════════════════════════╗
    ║        MENÚ PRINCIPAL                 ║
    ╠═══════════════════════════════════════╣
    ║  1. 🔎  Buscar Digipymon              ║
    ║  2. 🎮  Luchar contra otro Entrenador ║
    ║  3. 🛒  Tienda                        ║
    ║  4. 💰  Usar Objetos                  ║
    ║  5. 🧾  Inventario                    ║
    ║  6. 🐲  Digipymons                    ║
    ║  7. ❌  Salir                         ║
    ╚═══════════════════════════════════════╝
    """)
    
    
    
def buscar_digipymon(jugador, inventario):
    
    digipymon = generar_digipymon_aleatorio()
    print(f"Acabas de cruzarte con un Digipymon: {digipymon}")
    probabilidad_c = 100 - (digipymon.nivel * 10)
    print(f"La probabilidad que tienes de capturarlo es del {probabilidad_c}%")
    eleccion = input("¿Quieres capturar a este digipymon? s/n ")
    if eleccion == "s":
        if "digipyball" not in inventario.objetos:
                print("No te quedan digipyballs")
        elif jugador.cantidad_digipymon >= 6:
            print("No puedes capturar mas digipymons. El limite permitido es 6")
        else:
            if random.randint(1, 100) <= probabilidad_c:
                jugador.añadir_digipymon(digipymon)
                print(f"Enhorabuena has capturado a: {digipymon}")
                inventario.usar_objeto("digipyball")
            else:
                print(f"Vaya parece que no has tenido suerte esta vez {digipymon} ha escapado")
                inventario.usar_objeto("digipyball")
    elif eleccion == "n":
        print("Has huido")
    else:
        print("Eleccion Incorrecta")

def combate(jugador):
    nombres = ListaNombres()
    nombre_e = nombres.obtener_nombre_entrenador()
    enemigo = Enemigo(nombre_e)
    for i in range(jugador.cantidad_digipymon):
        enemigo.añadir_digipymon(generar_digipymon_aleatorio())
        
    print(f"Te toca combatir contra {enemigo}")
    respuesta = input("¿Quieres combatir contra el o prefieres huir? s/n \n\
       Si decides huir perderas 1 digicoin ")
        
    if respuesta == "s":
        victorias = 0
        derrotas = 0
        for i in range(jugador.cantidad_digipymon):
            digipymon_j = jugador.lista_digipymon[i]
            digipymon_e = enemigo.lista_digimons[i]
            print(f"Combate {i + 1}")
            print(f"Tu digipymon: {digipymon_j}")
            print(f"Luchas contra {digipymon_e} ")
            
            
            if digipymon_j.vida <= 0:
                print("Tu digipymon esta fuera de combate. Pierdes este enfrentamiento")
                derrotas += 1
            else:
                
                if digipymon_j.ataque > digipymon_e.ataque:
                    print("Has gando el combate")
                    digipymon_j.vida = digipymon_j.vida - digipymon_e.ataque
                    if digipymon_j.vida < 0:
                        digipymon_j.vida = 0
                    print(f"Tu digipymon ha perdido: {digipymon_e.ataque} de vida. La vida actual de tu digipymon es {digipymon_j.vida}")
                    victorias += 1
                elif digipymon_j.ataque < digipymon_e.ataque:
                    print("Has perdido el combate")
                    diferencia = digipymon_e.ataque - digipymon_j.ataque
                    digipymon_j.vida = digipymon_j.vida - diferencia
                    if digipymon_j.vida < 0:
                        digipymon_j.vida = 0
                    print(f"Tu digipymon ha perdido: {diferencia} de vida. La vida actual de tu digipymon es {digipymon_j.vida}")
                    derrotas += 1
                else:
                    print("Has empatado")
            
            print(f"Resultado final del combate ---- Victorias: {victorias}  Derrotas: {derrotas}")
            if victorias > derrotas:
                jugador.digicoins = jugador.digicoins + victorias
                print(f"Has ganado la pelea contra {enemigo}. Ganas: {victorias} digicoins")
            elif victorias < derrotas:
                if jugador.digicoins >= derrotas:
                    jugador.digicoins = jugador.digicoins - derrotas
                else:
                    jugador.digicoins = 0
                    print(f"Has perdido la pelea contra {enemigo}. Pierdes: {derrotas} digicoins")
            else:
                print("Has empatado por lo que no pierdes ni ganas digicoins")
                
        
    elif respuesta == "n":
        if jugador.digicoins > 0:
            jugador.digicoins -= 1
            print("Has decidido huir por lo que pierdes 1 digicoin")
        else:
            print("No tienes digicoins por lo que no pierdes nada")
    else:
        print("Opcion Incorrecta")
        
    
def digishop(jugador, inventario):
    print("""
    ╔═══════════════════════════════════════════════════════════════════════════╗
    ║              Tienda                                                       ║
    ║     Los objetos disponibles son:                                          ║
    ╠═══════════════════════════════════════════════════════════════════════════╣
    ║  1. 🥎  Digipyballs --- 5 Digicoins (Esenciales para capturar Digipymons) ║
    ║  2. 🍾  Pocion --- 3 Digicoins (+10 ptos. Regeneracion de vida)           ║
    ║  3. 💊  Anabolizantes --- 4 Digicoins (+5 ptos. Ataque)                   ║
    ╚═══════════════════════════════════════════════════════════════════════════╝
    """)
    print(f"Tienes: {jugador.digicoins} digicoins")
    
    objeto = input("¿Que objeto quieres comprar? ")
    
    if objeto == "1":
        if jugador.digicoins >= 5:
            print("Acabas de comprar una Digypiball")
            inventario.añadir_objeto("digipyball", 1)
            jugador.digicoins = jugador.digicoins - 5
        else:
            print("Eres pobre y no tienes dinero")
    elif objeto == "2":
        if jugador.digicoins >= 3:
            print("Acabas de comprar una Pocion")
            inventario.añadir_objeto("Pocion", 1)
            jugador.digicoins = jugador.digicoins - 3
        else:
            print("No puedes comprar este objeto")
    elif objeto == "3":
        if jugador.digicoins >= 4:
            print("Acabas de comprar un Anabolizante")
            inventario.añadir_objeto("anabolizante", 1)
            jugador.digicoins = jugador.digicoins - 4
        else:
            print("No puedes comprar este objeto")
    else:
        print("Opcion incorrecta")
        
def usar_item(inventario,jugador):
    inventario.consultar_inventario()
    objeto = input("¿Qué item quieres usar? ").lower()
    if objeto == "digipyball":
        print("No se puede usar este ITEM.")
    else:
        if objeto not in inventario.objetos:
            print("No tienes ese objeto.")
            
        else:
            jugador.consultar_digipymon()
            opcion = int(input("¿A que Digipymon lo quieres aplicar?(1-6) "))

            digipymon = jugador.lista_digipymon[opcion - 1]

            if objeto == "pocion":
                inventario.usar_objeto(objeto)
                digipymon.vida += 10
                print(f" Tu {digipymon.nombre} gana +10 de vida. Valor de vida actual: {digipymon.vida}")
            elif objeto == "anabolizante":
                inventario.usar_objeto(objeto)
                digipymon.ataque += 5
                print(f" Tu {digipymon.nombre} gana +5 de ataque. Valor de ataque actual: {digipymon.ataque}")
            else:
                print("Ese objeto no existe.")
                

        

def main():
    print("Bienvenido a DIGIPYMON => En este mundo virtual, criaturas llamadas Digipymon, combaten y forman lazos con sus entrenadores")
    print("Tú eres uno de esos entrenadores, y tu misión es explorar este mundo, capturar Digipymon únicos y enfrentarte a desafíos cada vez más complejos")
    nombre = input("Introduce tu nombre de entrenador: ")
    jugador = Jugador(nombre)
    inventario = Inventario()
    #lista_nombres = ListaNombres()

    print("Vamos a generar a tu primer Digipymon ... Tendras suerte o no.... ")
    digipymon_primero = generar_digipymon_aleatorio()
    jugador.añadir_digipymon(digipymon_primero)
    print(f"Tu primer Digipymon es ... {digipymon_primero.nombre}!")

    print("Para que puedas empezar tu aventura te vamos a regalar 3 digipyballs y 1 poción .")
    inventario.añadir_objeto("digipyball", 3)
    inventario.añadir_objeto("pocion", 1)
    opcion = True
    while opcion:
        menu()
        opciones = input("Elige la opcion que prefieras: ")
        if opciones == "1":
            buscar_digipymon(jugador, inventario)
        elif opciones == "2":
            combate(jugador)
        elif opciones == "3":
            digishop(jugador, inventario)
        elif opciones == "4":
            usar_item(inventario, jugador)
        elif opciones == "5":
            inventario.consultar_inventario()
        elif opciones == "6":
            jugador.consultar_digipymon()
        elif opciones == "7":
            print("Estas saliendo del juego... Nos vemos en la proxima!")
            opcion = False
        else:
            print("Opción invalida introduce un numero.")

main()

