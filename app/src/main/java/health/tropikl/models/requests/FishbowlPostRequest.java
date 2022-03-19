package health.tropikl.models.requests;

import java.util.List;

/**
 * Created by Kavika F.
 */

public class FishbowlPostRequest
{
	private final int userID;
	private final List<String> colors;

	public FishbowlPostRequest(int userID, List<String> colors) {
		this.userID = userID;
		this.colors = colors;
	}

	public int getUserID() { return userID; }

	public List<String> getColors() { return colors; }
}
