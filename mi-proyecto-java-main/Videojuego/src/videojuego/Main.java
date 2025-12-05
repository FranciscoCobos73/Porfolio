package videojuego;

import java.io.IOException;
import java.io.Serializable;
import java.lang.Math;
import java.util.Scanner;
import java.io.*; //TE METE TODAS LAS IO
import java.io.FilterInputStream;

/**
 * Version Final Tarea Programacion. Francisco Cobos 1º DAW
 *
 * @author Francisco Cobos Hidalga.
 * @version 1.0
 */
public class Main {

    public static void main(String[] args) {

        Jugador jugador1 = new Jugador(); //Crear objeto jugador 1
        boolean infinito = true; //Para menu Principal
        String opcion;
        Scanner teclado = new Scanner(System.in);
        String[] nombreEnemigos = {"Javi", "Jose", "Luis", "Maria Jose"}; //Array de String con nombres.
        System.out.println("Bienvenido al reinado Medac...");
        System.out.println("Quieres cargar la partida o empezar una nueva(s/n)");
        opcion = teclado.next();
        if (opcion.equals("s")) {
            try {
                ObjectInputStream cargar = new ObjectInputStream(new FileInputStream("C:\\Users\\AlumnoT\\Downloads\\mi-proyecto-java-main\\mi-proyecto-java-main\\Videojuego\\datosguardados.dat"
                ));
                jugador1 = (Jugador) cargar.readObject();
                System.out.println("Partida cargada correctamente.");
            } catch (IOException | ClassNotFoundException e) { //OJO ESTA EXCEPCION ME LA DICHO ALEX QUE ERA ASI
                System.err.println("Eror con el fichero " + e); //OJO!Serr no sout

                //CONDICION PARA SALIR DEL DOCUMENTO.
            }
        } else {
            System.out.println("Introduce tu nombre: ");
            jugador1.setNombre(teclado.next()); //Le fijo al objeto el nombre introducido por consola
            System.out.println("Vamos a calcular tu fuerza inicial...");

            jugador1.getDinero();//Obtengo mi dinero inicial.
            jugador1.calcularFuerzaInicial();//Obtengo mi fuerza inical.

            do {
                System.out.println("Te quedan " + jugador1.getDinero() + " de monedas...Quieres volver a probar suerte con tu fuerza inicial por una moneda? (s/n)");
                opcion = teclado.next();
                if (opcion.equals("s")) {
                    jugador1.calcularFuerzaInicial();
                    jugador1.setDinero(jugador1.getDinero() - 1);
                } else if (opcion.equals("n")) {
                    break;
                } else {
                    System.out.println("Caracter no valido");
                }
            } while (jugador1.getDinero() > 0);
            jugador1.getPuntosAtaque();
            System.out.println("------------------------------------------------------------------");
            System.out.println("Perfecto, tu fuerza sera " + jugador1.getPuntosAtaque() + " puntos");
        }

        //---------------------------------------------------------------------------------------
        do {
            System.out.println("Este es el menu del reinado Medac");
            System.out.println("1. Luchar contra enemigos");
            System.out.println("2. Comprar items");
            System.out.println("3. Consultar tus estadisticas");
            System.out.println("4. Salir del juego");
            System.out.println("5. Para guardar partida");
            opcion = teclado.next();

            switch (opcion) {
                case "1":
                    int random = (int) (Math.random() * nombreEnemigos.length);
                    /*genera un número aleatorio y lo guardo en variable random */
                    String nombreEnemigo = nombreEnemigos[random];
                    /* Con ese numero aleatorio, obtiene el nombre almacenado en esa posicion. */
                    //Lo guardo en un String nombre Enemigo.

                    Enemigo enemigo1 = new Enemigo(nombreEnemigo); //Le paso por parametro el nombre.
                    // Crea un objeto de la clase Enemigo y le paso el nombre con el string.

                    enemigo1.calcularFuerzaEnemigo();
                    System.out.println(enemigo1.toString());

                    if (jugador1.getPuntosAtaque() > enemigo1.getPuntosAtaque()) {
                        int oro = enemigo1.soltarDinero();
                        jugador1.setDinero(jugador1.getDinero() + oro);
                        System.out.println("Has ganado y obtienes " + oro + " de oro.");
                    } else if (jugador1.getPuntosAtaque() == enemigo1.getPuntosAtaque()) {
                        System.out.println("Has empatado y no obtienes oro, ni pierdes puntos de salud");
                    } else {
                        int puntosPerdidos = enemigo1.getPuntosAtaque() - jugador1.getPuntosAtaque();
                        jugador1.setPuntosSalud(jugador1.getPuntosSalud() - puntosPerdidos);
                        System.out.println("Has perdido el combate");
                        System.out.println("Como consecuencia tienes " + puntosPerdidos + " puntos menos de salud");
                        if (jugador1.getPuntosSalud() <= 0) {
                            System.out.println("Te has quedado sin puntos, pierdes el juego.");
                            infinito = false;
                        }
                    }
                    break;

                case "2":
                    //*CREO 3 OBJETOS DE MI CLASE ITEM Y LE PASO POR PARAMETROS SUS ATRIBUTOS.

                    Item item1 = new Item("Pocima Secreta", 5, 0, 3);
                    Item item2 = new Item("Machete", 8, 5, 0);
                    Item item3 = new Item("Escudo", 12, 3, 6);

                    String opcionCompra = "0";
                    do {

                        System.out.println("\nTienda de items:");
                        System.out.println("1. " + item1.toString());
                        System.out.println("2. " + item2.toString());
                        System.out.println("3. " + item3.toString());
                        System.out.println("4. Volver al menu");

                        System.out.println("\n Oro disponible: " + jugador1.getDinero());
                        System.out.print("Que quieres comprar? (Introduce el numero): ");
                        opcionCompra = teclado.next();
                        teclado.nextLine(); // Consumir salto de línea

                        switch (opcionCompra) {
                            case "1":
                                if (jugador1.getDinero() >= item1.getPrecio()) {
                                    jugador1.setDinero(jugador1.getDinero() - item1.getPrecio());
                                    jugador1.setPuntosSalud(jugador1.getPuntosSalud() + item1.getPuntosSalud());
                                    System.out.println("ENHORABUENA! Ahora tienes una: " + item1.getNombre());
                                    System.out.println("Ahora tu salud es: " + jugador1.getPuntosSalud() + " puntos");
                                } else {
                                    System.out.println("NO TIENES DINERO POBRE!!!");
                                }

                                break;

                            case "2":
                                if (jugador1.getDinero() >= item2.getPrecio()) {
                                    jugador1.setDinero(jugador1.getDinero() - item2.getPrecio());
                                    jugador1.setPuntosAtaque(jugador1.getPuntosAtaque() + item2.getPuntosAtaque());
                                    System.out.println("ENHORABUENA! Ahora tienes un: " + item2.getNombre());
                                    System.out.println("Ahora tu ataque es: " + jugador1.getPuntosAtaque() + " puntos");
                                } else {
                                    System.out.println("NO TIENES DINERO POBRE!!!");
                                }

                                break;

                            case "3":
                                if (jugador1.getDinero() >= item3.getPrecio()) {
                                    jugador1.setDinero(jugador1.getDinero() - item3.getPrecio());
                                    jugador1.setPuntosAtaque(jugador1.getPuntosAtaque() + item3.getPuntosAtaque());
                                    jugador1.setPuntosSalud(jugador1.getPuntosSalud() + item3.getPuntosSalud());
                                    System.out.println("ENHORABUENA! Ahora tienes un: " + item3.getNombre());
                                    System.out.println("Ahora tu ataque es de: " + jugador1.getPuntosAtaque() + " puntos, y tu salud es de: " + jugador1.getPuntosSalud() + " puntos");

                                } else {
                                    System.out.println("NO TIENES DINERO POBRE!!!");
                                }
                                break;
                            case "4":

                                break;

                            default:
                                System.out.println("Opción no valida.");
                                break;
                        }

                        if (opcionCompra.equals("4")) { //Condicion final para salir del do while
                            break; // Break del menu de items.
                        }

                    } while (opcionCompra != "1" || opcionCompra != "2" || opcionCompra != "3" || opcionCompra != "4");
//Mientras se cumpla una de las condiciones sigue corriendo el bucle.
                case "3":
                    System.out.println(jugador1.toString());
                    break;

                case "4":
                    System.out.println("Saliendo del juego");
                    infinito = false;
                    break;
                case "5":
                    try {
                        ObjectOutputStream guardar = new ObjectOutputStream(new FileOutputStream("C:\\Users\\AlumnoT\\Downloads\\mi-proyecto-java-main\\mi-proyecto-java-main\\Videojuego\\datosguardados.dat"));

                        guardar.writeObject(jugador1);
                        System.out.println("Partidad guarda correctamente");
                    } catch (IOException e) {
                        System.err.println("Error con el fichero " + e); //OJO!Serr no sout

                        //CONDICION PARA SALIR DEL DOCUMENTO.
                    }
                    break;

                default:
                    System.out.println("Caracter no valido, vuelve a escoger otra opcion. "); //Default de mi menu principal .
                }
        } while (infinito == true); //While del menu principal
    }
}
