package health.tropikl.models.requests;

/**
 * Created by Kavika F.
 */

public class DateExistsRequest
{
	int userID;
	String date;

	public DateExistsRequest(int userID, String date) {
		this.userID = userID;
		this.date = date;
	}

	public int getUserID() { return userID; }

	public String getDate() { return date; }
}
