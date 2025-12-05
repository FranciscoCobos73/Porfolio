package videojuego;

import java.io.Serializable;
import java.lang.Math;

/**
 * Clase Jugador que nos permite guardar atributos del jugador y llamar al
 * método que calcula su fuerza.
 *
 * @author Francisco Cobos Hidalga.
 * @version 1.0
 */
public class Jugador implements Serializable {

    private static final long serialVersionUID = 1L;
    private String nombre;
    private int puntos_salud, puntos_ataque, dinero;

    /**
     * Constructor por defecto.
     */
    public Jugador() {
        puntos_salud = 20;
        puntos_ataque = 0;
        dinero = 2;

    }

    /**
     * Constructor por parámetros.
     *
     * @param nombre Nombre del jugador.
     */
    public Jugador(String nombre) {
        this.nombre = nombre;
    }

    /**
     * Método get del atributo nombre.
     *
     * @return Devuelve el nombre del jugador.
     */
    public String getNombre() {
        return nombre;
    }

    /**
     * Método get del atributo puntos de salud.
     *
     * @return Devuelve los puntos de salud de mi jugador.
     */
    public int getPuntosSalud() {
        return puntos_salud;
    }

    /**
     * Método get del atributo puntos de ataque.
     *
     * @return Devuelve los puntos de ataque de mi jugador.
     */
    public int getPuntosAtaque() {
        return puntos_ataque;
    }

    /**
     * Método get del atributo dinero.
     *
     * @return Devuelve el dinero de mi jugador.
     */
    public int getDinero() {
        return dinero;
    }

    /**
     * Método set para actualizar el nombre del jugador.
     *
     * @param nombre Nombre del jugador.
     */
    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    /**
     * Método set para actualizar los puntos de salud del jugador.
     *
     * @param puntos_salud Puntos de salud del jugador.
     */
    public void setPuntosSalud(int puntos_salud) {
        this.puntos_salud = puntos_salud;
    }

    /**
     * Método set para actualizar los puntos de ataque del jugador.
     *
     * @param puntos_ataque Puntos de ataque del jugador.
     */
    public void setPuntosAtaque(int puntos_ataque) {
        this.puntos_ataque = puntos_ataque;
    }

    /**
     * Método set para actualizar el dinero del jugador.
     *
     * @param dinero Dinero que tiene el jugador.
     */
    public void setDinero(int dinero) {
        this.dinero = dinero;
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
        return " El nombre del heroe es " + nombre
                + "\n Tiene un total de  " + puntos_salud + " puntos de salud"
                + "\n Tiene " + puntos_ataque + " puntos de ataque"
                + "\n Tiene un total de " + dinero + " dinero";
    }

    /**
     * Método personalizado de tipo void el cual genera un número aleatorio.
     * Dicho número lo guardo en el atributo puntos de ataque de mi jugador y lo
     * muestro por pantalla.
     */
    public void calcularFuerzaInicial() {
        int random = (int) (Math.random() * 9);
        puntos_ataque = random;
        System.out.println("Tu fuerza incial es igual a " + puntos_ataque);
    }
}
