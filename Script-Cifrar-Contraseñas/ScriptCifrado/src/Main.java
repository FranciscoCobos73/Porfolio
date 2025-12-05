
import java.util.Scanner;

public class Main {

    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        // Pido la contraseña al usuario
        System.out.print(" Ingresa la contraseña a cifrar: ");
        String contraseña = scanner.nextLine();

        // Cifro la contraseña usando la clase CifradoSHA256
        String hashGenerado = CifradoSHA256.cifrarContraseña(contraseña);

        System.out.println("\n Hash generado: " + hashGenerado);

    }
}
