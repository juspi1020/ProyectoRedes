/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package simulador;

import java.io.IOException;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.application.Application;
import javafx.event.ActionEvent;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;
import javafx.scene.layout.GridPane;
import javafx.scene.layout.HBox;
import javafx.scene.paint.Color;
import javafx.scene.text.Font;
import javafx.scene.text.FontWeight;
import javafx.scene.text.Text;
import javafx.stage.Stage;

/**
 *
 * @author DELL
 */
public class Simulador extends Application {

    @Override
    public void start(Stage primaryStage) {
        primaryStage.setTitle("Agrega valore simulando un smartroom");

        GridPane grid = new GridPane();
        grid.setAlignment(Pos.CENTER);
        grid.setHgap(10);
        grid.setVgap(10);
        grid.setPadding(new Insets(25, 25, 25, 25));
        Text scenetitle = new Text("Smartroom");
        scenetitle.setFont(Font.font("Tahoma", FontWeight.NORMAL, 20));
        grid.add(scenetitle, 0, 0, 2, 1);

        Button btn = new Button("Envia");
        HBox hbBtn = new HBox(10);
        hbBtn.setAlignment(Pos.BOTTOM_RIGHT);
        hbBtn.getChildren().add(btn);
        grid.add(hbBtn, 1, 2);

        final Text actiontarget = new Text();
        grid.add(actiontarget, 1, 6);

        Scene scene = new Scene(grid, 300, 275);
        primaryStage.setScene(scene);

        primaryStage.show();

     

        btn.setOnAction((ActionEvent e) -> {
            try {
                URL url = new URL("http://Project-josedavgarcia615767.codeanyapp.com/smartroom");
                HttpURLConnection conn = (HttpURLConnection) url.openConnection();
                conn.setDoOutput(true);
                conn.setRequestMethod("POST");
                conn.setRequestProperty("Content-Type", "application/json");
                
                                 
                   
               String inputJson = "{"
                        + "\"temperatura\": 22,"
                        + "\"humedad\": 18,"
                        + "\"movimiento\": 0,"
                        + "\"luz\": 0,"
                        + "\"toque\": 0,"
                        + "\"fecha\": \"17/06/2020\","
                        + "\"hora\": \"9:08 am\","
                        + "\"id_usuariodr\": 1 "
                        + "}";

                OutputStream os = conn.getOutputStream();
                os.write(inputJson.getBytes());
                os.flush();
                
                if (conn.getResponseCode() != 200) {
                    throw new RuntimeException("Failed : HTTP error code : " + conn.getResponseCode());
                }

                conn.disconnect();

            } catch (MalformedURLException ex) {
                Logger.getLogger(Simulador.class.getName()).log(Level.SEVERE, null, ex);
            } catch (IOException ex) {
                Logger.getLogger(Simulador.class.getName()).log(Level.SEVERE, null, ex);
            }
            actiontarget.setFill(Color.FIREBRICK);
            actiontarget.setText("Valores Enviados");
           
          
        });

    }

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        launch(args);
    }

}
