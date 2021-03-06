
public class JobListActivity extends AppCompatActivity {
	
	static String[][] Items;
    private GoogleApiClient client;
	
	@Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        this.requestWindowFeature(Window.FEATURE_NO_TITLE);
        setContentView(R.layout.activity_list_job);
		
		RequestQueue request_queue = Volley.newRequestQueue(JobListActivity.this);
		StringRequest request = new StringRequest(Request.Method.POST, SERVER_URL+"/mobile/job/view", new Response.Listener<String>() {
								@Override
								public void onResponse(String server_response) {
								try {
                    			JSONArray JsonArray = new JSONArray(server_response);
								 Items = new String[JsonArray.length()][6];
								for(int i=0; i<=JsonArray.length(); i++){
									JSONObject json_object = JsonArray.getJSONObject(i);
									Items[i][0] = json_object.getString("job_source_id");
				Items[i][1] = json_object.getString("job_title");
				Items[i][2] = json_object.getString("job_detail");
				Items[i][3] = json_object.getString("job_end_date");
				Items[i][4] = json_object.getString("job_image");
				Items[i][5] = json_object.getString("job_summary");
				
			
								}
								
								JobAdapter jobAdapter;
                    			jobAdapter = new JobAdapter(JobListActivity.this,Items);
                    			job_listView.setAdapter(jobAdapter);
			
			
							} catch (JSONException e) {
								e.printStackTrace();
							    Toast.makeText(JobListActivity, "Error in Json", Toast.LENGTH_SHORT).show();
							}
								}
							}, new Response.ErrorListener() {
								@Override
								public void onErrorResponse(VolleyError volleyError) {
								Toast.makeText(JobListActivity, volleyError.toString(), Toast.LENGTH_SHORT).show();
								}
							}){
								@Override
								protected Map<String, String> getParams()  {
									HashMap<String,String> params = new HashMap<String,String>();
									return params;
								}
							};
							
				 request_queue.add(request);
		
		
		
 job_listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent i = new Intent(JobListActivity.this, JobView.class);
                i.putExtra("job_id", Items[position][0]);
                startActivity(i);
            }
        });
		
		

        
    }

}
