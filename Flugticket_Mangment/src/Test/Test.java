package Test;

import java.sql.*;

public class Test {
	
	public static void main (String[] args) {
		
		try {
			Connection myConn = DriverManager.getConnection("jdbc:mysql://localhost:3306/list_3ahit", "root", "Chelj20101999");

			Statement myStat = myConn.createStatement();
			ResultSet myRs = myStat.executeQuery("select * from planes");
			
			while(myRs.next()){
				System.out.println(myRs.getInt("maxspeed"));
			}
			
			
		}catch(Exception e) {
			e.printStackTrace();
		}
	}

}
