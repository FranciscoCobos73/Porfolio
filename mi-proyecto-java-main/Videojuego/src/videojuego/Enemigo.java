package videojuego;

import java.lang.Math;

/**
 * Clase Enemigo que nos permite guardar atributos del enemigo y llamar al
 * método que calcula su fuerza y las monedas que puede soltar.
 *
 * @author Francisco Cobos Hidalga.
 * @version 1.0
 */
public class Enemigo {

    private String nombre;
    private int puntos_ataque;

    /**
     * Constructor por defecto.
     */
    public Enemigo() {
        puntos_ataque = 0;
    }

    /**
     * Constructor por parámetros.
     *
     * @param nombre Nombre del enenmigo.
     */
    public Enemigo(String nombre) {
        this.nombre = nombre;
    }

    /**
     * Método get del atributo nombre.
     *
     * @return Devuelve el nombre del enemigo.
     */
    public String getNombre() {
        return nombre;
    }

    /**
     * Método get del atributo puntos de ataque.
     *
     * @return Devuelve los puntos de ataque del enemigo.
     */
    public int getPuntosAtaque() {
        return puntos_ataque;
    }

    /**
     * Método set para actualizar el nombre del enemigo.
     *
     * @param nombre Nombre del enemigo.
     */
    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    /**
     * Método set para actualizar los puntos de ataque del enemigo.
     *
     * @param puntos_ataque Puntos de ataque del enemigo.
     */
    public void setPuntosAtaque(int puntos_ataque) {
        this.puntos_ataque = puntos_ataque;
    }

    /**
     * Método toString para imprimir los atributos, el cual sobrescribimos con
     *
     * @Override
     *
     * @return Nos devuelde un system.out.println() con todos los atributos
     * impresos.
     */
    @Override
    public String toString() {
        return "El nombre de tu proximo enemigo es " + nombre
                + "\n y tiene una fuerza de " + puntos_ataque
                + " puntos de ataque";
    }

    /**
     * Método personalizado de tipo void el cual genera un número aleatorio.
     * Dicho número lo guardo en el atributo puntos de ataque de mi jugador.
     */
    public void calcularFuerzaEnemigo() {
        int random = (int) (Math.random() * 9);
        puntos_ataque = random;

    }

    /**
     * Método personalizado de tipo int el cual genera un número aleatorio.
     * Dicho número aleatorio sería el numero de monedas que va soltar el
     * enemigo y lo devuevlo con return.
     *
     * @return Devuelve un numero de monedas.
     */
    public int soltarDinero() {
        int random = (int) (Math.random() * 4);
        return random;
    }
}
