package health.tropikl.services;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

class ConnectionSetup
{
	private ConnectionSetup() {}

	/**
	 * Sets up a connection to the database.
	 * @return Returns the connection made.
	 */
	static Connection setup()
	{
		try
		{
			final String driver = "com.mysql.cj.jdbc.Driver";
			Class.forName(driver);
		}
		catch (ClassNotFoundException e)
		{
			System.out.println("ERROR: Class not found - Connection Setup");
			e.printStackTrace();
		}
		//151.106.97.181
		//sql451.main-hosting.eu
		//u699663088
		String serverName = "151.106.97.181";
		String portNumber = "3306";
		String dbName = "u699663088_fishbowl";
		String username = "root";//"u699663088_mrfish";
		String password = "";//"Fishtaco7";
		String connectionURL = "jdbc:mysql://" + serverName + ":" + portNumber + "/" + dbName;// +
				//"?user=" + username + "&password=" + password;

		Connection connection = null;
		try
		{
			connection = DriverManager.getConnection(connectionURL, username, password);
			connection.setAutoCommit(false);
		}
		catch (SQLException e)
		{
			System.out.println("ERROR: SQL Exception thrown - Connection Setup");
			e.printStackTrace();
		}
		return connection;
	}
}