
public class JobSourceAddActivity extends AppCompatActivity {
	
	private text job_source_title;
				private EditText job_source_logo;
				private Button btn_add_job_source;
	
	@Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        this.requestWindowFeature(Window.FEATURE_NO_TITLE);
        setContentView(R.layout.activity_add_job_source);
		
		job_source_title = (text)findViewById(R.id.job_source_title);
				job_source_logo = (EditText)findViewById(R.id.job_source_logo);
				btn_add_job_source = (Button)findViewById(R.id.btn_add_job_source);
		
		
btn_add_job_source.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //do your code here
				final String form_job_source_title = job_source_title.getText().toString();
				final String form_job_source_logo = job_source_logo.getText().toString();
				
				
				RequestQueue request_queue = Volley.newRequestQueue(JobSourceAddActivity.this); 
				 StringRequest request = new StringRequest(Request.Method.POST, SERVER_URL+"/mobile/job_source/save_data", new Response.Listener<String>() {
								@Override
								public void onResponse(String server_response) {
								Toast.makeText(JobSourceAddActivity.this, server_response, Toast.LENGTH_SHORT).show();
								}
							}, new Response.ErrorListener() {
								@Override
								public void onErrorResponse(VolleyError volleyError) {
								Toast.makeText(JobSourceAddActivity.this, volleyError.toString(), Toast.LENGTH_SHORT).show();
								}
							}){
								@Override
								protected Map<String, String> getParams()  {
									HashMap<String,String> params = new HashMap<String,String>();
									params.put("job_source_title", form_job_source_title);
				params.put("job_source_logo", form_job_source_logo);
				
									return params;
								}
							};
							
				 request_queue.add(request);
				
				
            }
        });
//end here .....
		
		

     }

}
