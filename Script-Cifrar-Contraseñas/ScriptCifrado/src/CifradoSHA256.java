
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;

public class CifradoSHA256 {

    // Método para cifrar la contraseña con SHA-256
    public static String cifrarContraseña(String contraseña) {
        try {
            MessageDigest digest = MessageDigest.getInstance("SHA-256");
            byte[] hash = digest.digest(contraseña.getBytes());

            // Convertimos el hash a formato hexadecimal
            StringBuilder hexString = new StringBuilder();
            for (byte b : hash) {
                hexString.append(String.format("%02x", b));
            }
            return hexString.toString();

        } catch (NoSuchAlgorithmException e) {
            throw new RuntimeException("Error al cifrar la contraseña", e);
        }
    }
}
