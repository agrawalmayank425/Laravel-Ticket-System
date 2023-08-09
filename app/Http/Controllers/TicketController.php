<?php
  
namespace App\Http\Controllers;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Ticket;
use Hash;
use DB;
use Illuminate\Support\Facades\Validator;
  
class TicketController extends Controller
{
    
    public function assign_ticket()
    {
        $assign_user_tickets = Ticket::where('assign_user_id',Auth::id())->get();
        return view('ticket.assign_ticket',compact('assign_user_tickets'));
    }  
    
    public function my_ticket()
    {
        $my_tickets = Ticket::where('user_id',Auth::id())->get();
        return view('ticket.my_ticket', compact('my_tickets'));
    }  
    
    public function ticket_view($id)
    {
        $ticket = Ticket::where('id',$id)->first();
        return view('ticket.ticket_view', compact('ticket'));
    }  
    
    public function ticket_close($id)
    {
        $ticket = Ticket::where('id',$id)->update(['status'=>'Closed']);
        return redirect()->route('assign_ticket');
        // return view('ticket.ticket_view', compact('ticket'));
    }  
    
    public function create_ticket()
    {
        // dd(Auth::user()->id);
        $assign_user = User::where('id','!=',Auth::user()->id)->get();
        return view('ticket.create_ticket', compact('assign_user'));
    }  
    
    public function ticket_store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            // 'status' => 'required',
            'assign_user_id' => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('create_ticket')->withErrors($validator)->withInput();
            }
        }
        // dd($request->assign_user_id);
        $blog = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'Pending',
            // 'status' => $request->status,
            'user_id' => Auth::id(),
            'assign_user_id' => $request->assign_user_id,
        ]);
        if ($blog) {
            return redirect()->route('my_ticket')->with('success', __('Ticket created successfully!'));
        }
        return redirect()->back()->with('error', __('Ticket not create. Please try again later.'));
        // return view('ticket.create_ticket');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }
  
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('Great! You have Successfully logged in');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}