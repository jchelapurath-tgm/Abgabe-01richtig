package Test;

public class Flughafen {
	
	String Land;
	String Stadt;
	String	airportcode;
	String name;
	String FlullLand;
	
	public String getFlullLand() {
		return FlullLand;
	}

	public void setFlullLand(String flullLand) {
		FlullLand = flullLand;
	}

	public Flughafen(String Land, String Stadt, String airportcode,String name, String FullLand) {
		this.Land = Land;
		this.Stadt = Stadt;
		this.airportcode = airportcode;
		this.name = name;
		this.FlullLand = FullLand;
	}

	public String getLand() {
		return Land;
	}

	public void setLand(String land) {
		Land = land;
	}

	public String getStadt() {
		return Stadt;
	}

	public void setStadt(String stadt) {
		Stadt = stadt;
	}

	public String getAirportcode() {
		return airportcode;
	}

	public void setAirportcode(String airportcode) {
		this.airportcode = airportcode;
	}

	public String getName() {
		return name;
	}

	@Override
	public String toString() {
		return "Flughafen [Land=" + Land + ", Stadt=" + Stadt + ", airportcode=" + airportcode + ", name=" + name + "]" + "\n";
	}

	public void setName(String name) {
		this.name = name;
	}

}
