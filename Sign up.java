import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class SignUpScreenWithPopup {
    public static void main(String[] args) {
        // Create the main frame window
        JFrame frame = new JFrame("Plantify - SignUp");
        frame.setSize(400, 600);
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.setLayout(null);

        // Add a welcome label
        JLabel welcomeLabel = new JLabel("Welcome to");
        welcomeLabel.setFont(new Font("Arial", Font.BOLD, 20));
        welcomeLabel.setBounds(140, 20, 200, 30);
        frame.add(welcomeLabel);

        // Add the app title label
        JLabel titleLabel = new JLabel("Plantify");
        titleLabel.setFont(new Font("Arial", Font.BOLD, 25));
        titleLabel.setForeground(new Color(34, 139, 34));
        titleLabel.setBounds(160, 50, 200, 30);
        frame.add(titleLabel);

        // Add "Username" label
        JLabel usernameLabel = new JLabel("Username");
        usernameLabel.setFont(new Font("Arial", Font.PLAIN, 16));
        usernameLabel.setBounds(50, 120, 100, 20);
        frame.add(usernameLabel);

        // Add username text field
        JTextField usernameField = new JTextField();
        usernameField.setBounds(50, 150, 300, 30);
        frame.add(usernameField);

        // Add "Password" label
        JLabel passwordLabel = new JLabel("Password");
        passwordLabel.setFont(new Font("Arial", Font.PLAIN, 16));
        passwordLabel.setBounds(50, 220, 100, 20);
        frame.add(passwordLabel);

        // Add password field
        JPasswordField passwordField = new JPasswordField();
        passwordField.setBounds(50, 250, 300, 30);
        frame.add(passwordField);

        // Add "Login" button
        JButton SignUpButton = new JButton("Sign up");
        SignUpButton.setBounds(50, 320, 140, 40);
        SignUpButton.setBackground(new Color(34, 139, 34));
        SignUpButton.setForeground(Color.WHITE);
        frame.add(SignUpButton);

        // Add "Forget Password" button
        JButton forgetButton = new JButton("Forget Password");
        forgetButton.setBounds(210, 320, 140, 40);
        forgetButton.setBackground(Color.LIGHT_GRAY);
        frame.add(forgetButton);

        // Action for "Login" button
        loginButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String username = usernameField.getText();
                String password = new String(passwordField.getPassword());

                // Simple validation
                if (username.equals("user") && password.equals("1234")) {
                    JOptionPane.showMessageDialog(frame,
                            "Login Successful! Welcome, " + username,
                            "Success",
                            JOptionPane.INFORMATION_MESSAGE);
                } else {
                    JOptionPane.showMessageDialog(frame,
                            "Invalid Username or Password!",
                            "Error",
                            JOptionPane.ERROR_MESSAGE);
                }
            }
        });

        // Action for "Forget Password" button
        forgetButton.addActionListener(e -> {
            JOptionPane.showMessageDialog(frame,
                    "Check your email to create a new password", // Message
                    "Forgot Password",                         // Title
                    JOptionPane.INFORMATION_MESSAGE);          // Icon type
        });

        // Make the frame visible
        frame.setVisible(true);
    }
}
