package Test;

import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.GroupLayout;
import javax.swing.GroupLayout.Alignment;
import javax.swing.JTextField;
import javax.swing.JLabel;
import java.awt.Font;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.ArrayList;

import javax.swing.LayoutStyle.ComponentPlacement;
import javax.swing.JButton;
import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;

public class Test2 {

	static ArrayList<Flughafen> flughafen= new ArrayList<Flughafen>();
	
	private JFrame frame;
	private JTextField textField;
	private JTextField textField_1;
	private JTable table;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
		Connection myConn = DriverManager.getConnection("jdbc:mysql://localhost:3306/list_3ahit", "root", "Chelj20101999");

		Statement myStat = myConn.createStatement();
		ResultSet myRs = myStat.executeQuery("select * from airports");
		
		while(myRs.next()){
			flughafen.add(new Flughafen(myRs.getString("country"), myRs.getString("city"), myRs.getString("airportcode"), myRs.getString("name")));
		}
		System.out.println("");
		
		}catch(Exception e) {
			System.out.println(e.toString());
		}
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {

					Test2 window = new Test2();
					window.frame.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the application.
	 */
	public Test2() {
		initialize();
		for(int i = 0; i < flughafen.size();i++) {
			DefaultTableModel model = (DefaultTableModel) table.getModel();
			Object[] row = new Object[3];
			for (int ir = 0; ir < flughafen.size();ir++) {
				row[0] = flughafen.get(ir).getStadt();
				row[1] = flughafen.get(ir).getLand();
				row[2] = flughafen.get(ir).getAirportcode();
				
				model.addRow(row);
			}
		}
	}

	/**
	 * Initialize the contents of the frame.
	 */
	private void initialize() {
		frame = new JFrame();
		frame.setBounds(100, 100, 1013, 1081);
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		
		textField = new JTextField();
		textField.setColumns(10);
		
		JLabel lblAbflug = new JLabel("Abflug");
		lblAbflug.setFont(new Font("Tahoma", Font.PLAIN, 32));
		
		textField_1 = new JTextField();
		textField_1.setColumns(10);
		
		JLabel lblAnkunft = new JLabel("Ankunft");
		lblAnkunft.setFont(new Font("Tahoma", Font.PLAIN, 32));
		
		JButton Suchenbutton = new JButton("Suchen");
		
		table = new JTable();
		
		GroupLayout groupLayout = new GroupLayout(frame.getContentPane());
		groupLayout.setHorizontalGroup(
			groupLayout.createParallelGroup(Alignment.LEADING)
				.addGroup(groupLayout.createSequentialGroup()
					.addGap(187)
					.addComponent(lblAbflug, GroupLayout.PREFERRED_SIZE, 169, GroupLayout.PREFERRED_SIZE)
					.addPreferredGap(ComponentPlacement.RELATED, 307, Short.MAX_VALUE)
					.addComponent(lblAnkunft, GroupLayout.PREFERRED_SIZE, 169, GroupLayout.PREFERRED_SIZE)
					.addGap(163))
				.addGroup(groupLayout.createSequentialGroup()
					.addGap(35)
					.addComponent(textField, GroupLayout.PREFERRED_SIZE, 394, GroupLayout.PREFERRED_SIZE)
					.addPreferredGap(ComponentPlacement.RELATED, 120, Short.MAX_VALUE)
					.addComponent(textField_1, GroupLayout.PREFERRED_SIZE, 394, GroupLayout.PREFERRED_SIZE)
					.addGap(52))
				.addGroup(groupLayout.createSequentialGroup()
					.addGap(407)
					.addComponent(Suchenbutton, GroupLayout.PREFERRED_SIZE, 173, GroupLayout.PREFERRED_SIZE)
					.addContainerGap(415, Short.MAX_VALUE))
				.addGroup(Alignment.TRAILING, groupLayout.createSequentialGroup()
					.addContainerGap(296, Short.MAX_VALUE)
					.addComponent(table, GroupLayout.PREFERRED_SIZE, 382, GroupLayout.PREFERRED_SIZE)
					.addGap(317))
		);
		groupLayout.setVerticalGroup(
			groupLayout.createParallelGroup(Alignment.LEADING)
				.addGroup(groupLayout.createSequentialGroup()
					.addGroup(groupLayout.createParallelGroup(Alignment.LEADING)
						.addGroup(groupLayout.createSequentialGroup()
							.addGap(104)
							.addComponent(lblAbflug, GroupLayout.PREFERRED_SIZE, 55, GroupLayout.PREFERRED_SIZE))
						.addGroup(groupLayout.createSequentialGroup()
							.addGap(118)
							.addComponent(lblAnkunft, GroupLayout.PREFERRED_SIZE, 55, GroupLayout.PREFERRED_SIZE)))
					.addGap(34)
					.addGroup(groupLayout.createParallelGroup(Alignment.BASELINE)
						.addComponent(textField, GroupLayout.PREFERRED_SIZE, 45, GroupLayout.PREFERRED_SIZE)
						.addComponent(textField_1, GroupLayout.PREFERRED_SIZE, 45, GroupLayout.PREFERRED_SIZE))
					.addGap(35)
					.addComponent(Suchenbutton, GroupLayout.PREFERRED_SIZE, 70, GroupLayout.PREFERRED_SIZE)
					.addGap(99)
					.addComponent(table, GroupLayout.PREFERRED_SIZE, 277, GroupLayout.PREFERRED_SIZE)
					.addContainerGap(301, Short.MAX_VALUE))
		);
		frame.getContentPane().setLayout(groupLayout);
	}
}
