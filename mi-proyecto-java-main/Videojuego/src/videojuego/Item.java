package videojuego;

/**
 * Clase Item que nos permite guardar atributos de los items de la tienda.
 *
 * @author Francisco Cobos Hidalga.
 * @version 1.0
 */
public class Item {

    private String nombre;
    private int precio, puntos_ataque, puntos_salud;

    /**
     * Constructor por parámetros.
     *
     * @param nombre Nombre del producto.
     * @param precio Precio del producto.
     * @param puntos_ataque Puntos de ataque que añade el producto.
     * @param puntos_salud Puntos de salud que añade el producto.
     */
    public Item(String nombre, int precio, int puntos_ataque, int puntos_salud) {
        this.nombre = nombre;
        this.precio = precio;
        this.puntos_ataque = puntos_ataque;
        this.puntos_salud = puntos_salud;
    }

    /**
     * Método set para actualizar el nombre.
     *
     * @param nombre nombre del item de la tienda.
     */
    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    /**
     * Método set para actualizar el precio.
     *
     * @param precio precio del item de la tienda.
     */
    public void setPrecio(int precio) {
        this.precio = precio;
    }

    /**
     * Método set para actualizar los puntos de ataque.
     *
     * @param puntos_ataque puntos de ataque del item.
     */
    public void setPuntosAtaque(int puntos_ataque) {
        this.puntos_ataque = puntos_ataque;
    }

    /**
     * Método set para actualizar los puntos de salud.
     *
     * @param puntos_salud puntos de salud del item.
     */
    public void setPuntosSalud(int puntos_salud) {
        this.puntos_salud = puntos_salud;
    }

    // Getters
    /**
     * Método get del atributo nombre.
     *
     * @return Devuelve el nombre del item.
     */
    public String getNombre() {
        return nombre;
    }

    /**
     * Método get del atributo precio.
     *
     * @return Devuelve el precio del Item.
     */
    public int getPrecio() {
        return precio;
    }

    /**
     * Método get del atributo puntos de ataque.
     *
     * @return Devuelve los puntos de ataque de mi Item.
     */
    public int getPuntosAtaque() {
        return puntos_ataque;
    }

    /**
     * Método get del atributo puntos de salud.
     *
     * @return Devuelve los puntos de salud de mi Item.
     */
    public int getPuntosSalud() {
        return puntos_salud;
    }

    /**
     * Método toString para imprimir los atributos, el cual sobrescribimos con
     *
     * @Override
     *
     * @return Nos devuelde un system.out.println() con todos los atributos
     * impresos los cuales veremos cuando vayamos a la teinda.
     */
    @Override
    public String toString() {
        return nombre + ", Precio = " + precio + ", Mejora de Ataque = " + puntos_ataque + ", Mejora de Salud = " + puntos_salud + '}';
    }
}
