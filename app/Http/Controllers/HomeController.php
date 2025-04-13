<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Like;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\ProjectImage;

use Illuminate\Routing\Controller;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  // public function __construct()
  // {
  //   $this->middleware('auth');
  // }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function fallback()
  {
    return redirect()->route('home');
  }

  public function index()
{
    $categories = Category::all();
  
    $projects = Project::with(['user.profile', 'category', 'images'])
        ->withCount('likes')
        ->withCount('comments')
        ->with('userLike')
        ->get();
  
    $unreadUsers = Message::where('receiver_id', Auth::id())
        ->where('is_read', false)
        ->groupBy('sender_id')
        ->get(['sender_id']);
  
    $unreadUsersCount = $unreadUsers->count();
    $unreadUsersDetails = User::whereIn('id', $unreadUsers->pluck('sender_id'))->get();
      
    $likesOnMyProjects = null;
    $likesCount = 0;
    $subscriptionType = null;
    $userSubscriptionMessage = '';  

    if (Auth::check()) {
        $user = User::with('subscription.plan')->find(Auth::id());
        $subscription = $user->subscription;
        $subscriptionType = $subscription?->plan?->name ?? null;
        
        if ($subscriptionType === 'Normal') {
            $userSubscriptionMessage = 'You need to upgrade your subscription to access chat. Please subscribe to Pro Designer.';
        } elseif ($subscriptionType === 'Basic') {
            $userSubscriptionMessage = 'You need to upgrade your subscription to post featured projects. Please subscribe to Pro Designer.';
        }
  
        $likesOnMyProjects = Like::with(['user', 'project'])
            ->whereIn('project_id', $user->projects->pluck('id'))
            ->get();
  
        $likesCount = $likesOnMyProjects->count();
    } else {
        $userSubscriptionMessage = 'You need to log in to access all features.';
    }
  
    return view('welcome', compact(
        'categories',
        'projects',
        'unreadUsersCount',
        'unreadUsersDetails',
        'likesOnMyProjects',
        'likesCount',
        'userSubscriptionMessage',
        'subscriptionType'
    ));
}

  public function showProject($id)
  {
    $project = Project::with([
      'user.profile',
      'category',
      'comments' => function ($query) {
        $query->orderByDesc('created_at');
      },
      'comments.user',
    ])
      ->withCount('likes')
      ->withCount('comments')
      ->with('userLike')
      ->with('tags')
      ->findOrFail($id);

    $unreadUsers = Message::where('receiver_id', Auth::id())
      ->where('is_read', false)
      ->groupBy('sender_id')
      ->get(['sender_id']);

    $unreadUsersCount = $unreadUsers->count();

    $unreadUsersDetails = User::whereIn('id', $unreadUsers->pluck('sender_id'))->get();

    $categories = Category::all();
    $tags = Tag::all();
    $totalProjects = Project::count();

    foreach ($categories as $category) {
      $category->projects_count = Project::where('category_id', $category->id)->count();
    }

    if (!$project && !$categories && !$tags) {
      return redirect()->back()->with('error', 'Not found.');
    }

    if (Auth::check()) {
      $user = Auth::user();
      $likesOnMyProjects = Like::with(['user', 'project'])
        ->whereIn('project_id', $user->projects->pluck('id'))
        ->get();

      $likesCount = $likesOnMyProjects->count();
    } else {
      $likesOnMyProjects = null;
      $likesCount = 0;
    }

    return view('public.category.postdetails', compact('project', 'categories', 'tags', 'unreadUsersCount', 'unreadUsersDetails', 'totalProjects', 'likesOnMyProjects', 'likesCount'));
  }

  public function storeComments(Request $request, $id)
  {
    $request->validate([
      'comment' => 'required|string|max:255',
    ]);
    $user = Auth::user();
    if (!$user) {
      return redirect()->back()->with('error', 'You must be logged in to comment.');
    }
    $project = Project::findOrFail($id);
    $comment = $request->input('comment');
    $project->comments()->create([
      'user_id' => $user->id,
      'content' => $comment,
      'project_id' => $id
    ]);

    return redirect()->back();
  }

  public function post($id)
  {
    $categories = Category::all();
    $tags = Tag::all();

    if ($id == 0) {
      $projects = Project::withCount('likes')
        ->withCount('comments')
        ->with('userLike')
        ->orderBy('created_at', 'desc')
        ->paginate(10);
    } else {
      $projects = Project::where('category_id', $id)
        ->withCount('likes')
        ->withCount('comments')
        ->with('userLike')
        ->orderBy('created_at', 'desc')
        ->paginate(10);
    }

    $unreadUsers = Message::where('receiver_id', Auth::id())
      ->where('is_read', false)
      ->groupBy('sender_id')
      ->get(['sender_id']);

    $unreadUsersCount = $unreadUsers->count();
    $unreadUsersDetails = User::whereIn('id', $unreadUsers->pluck('sender_id'))->get();

    $totalProjects = Project::count();

    foreach ($categories as $category) {
      $category->projects_count = Project::where('category_id', $category->id)->count();
    }
    $subscriptionType = null;
    $userSubscriptionMessage = '';  
    if (Auth::check()) {
      $user = Auth::user();
      $likesOnMyProjects = Like::with(['user', 'project'])
        ->whereIn('project_id', $user->projects->pluck('id'))
        ->get();

      $likesCount = $likesOnMyProjects->count();
      $subscription = $user->subscription;
        $subscriptionType = $subscription?->plan?->name ?? null;
        
        if ($subscriptionType === 'Normal') {
            $userSubscriptionMessage = 'You need to upgrade your subscription to access chat. Please subscribe to Pro Designer.';
        } elseif ($subscriptionType === 'Basic') {
            $userSubscriptionMessage = 'You need to upgrade your subscription to post featured projects. Please subscribe to Pro Designer.';
        }
    } else {
      $likesOnMyProjects = null;
      $likesCount = 0;
    }

    return view('public.category.posts', compact(
      'categories',
      'tags',
      'projects',
      'unreadUsersCount',
      'unreadUsersDetails',
      'totalProjects',
      'likesOnMyProjects',
      'likesCount',
      'subscriptionType',
      'userSubscriptionMessage'
    ))->with('currentCategoryId', $id);
  }

  public function filterByTag($tagId)
  {
    $categories = Category::all();
    $tags = Tag::all();

    $projects = Project::whereHas('tags', function ($query) use ($tagId) {
      $query->where('tags.id', $tagId);
    })
      ->withCount('likes')
      ->withCount('comments')
      ->with('userLike')
      ->paginate(10);

    $unreadUsers = Message::where('receiver_id', Auth::id())
      ->where('is_read', false)
      ->groupBy('sender_id')
      ->get(['sender_id']);

    $unreadUsersCount = $unreadUsers->count();
    $unreadUsersDetails = User::whereIn('id', $unreadUsers->pluck('sender_id'))->get();

    $totalProjects = Project::count();

    foreach ($categories as $category) {
      $category->projects_count = Project::where('category_id', $category->id)->count();
    }
    $subscriptionType = null;
    $userSubscriptionMessage = ''; 
    if (Auth::check()) {
      $user = Auth::user();
      $likesOnMyProjects = Like::with(['user', 'project'])
        ->whereIn('project_id', $user->projects->pluck('id'))
        ->get();

      $likesCount = $likesOnMyProjects->count();
      $subscription = $user->subscription;
        $subscriptionType = $subscription?->plan?->name ?? null;
        
        if ($subscriptionType === 'Normal') {
            $userSubscriptionMessage = 'You need to upgrade your subscription to access chat. Please subscribe to Pro Designer.';
        } elseif ($subscriptionType === 'Basic') {
            $userSubscriptionMessage = 'You need to upgrade your subscription to post featured projects. Please subscribe to Pro Designer.';
        }
    } else {
      $likesOnMyProjects = null;
      $likesCount = 0;
    }

    return view('public.category.posts', compact(
      'categories',
      'tags',
      'projects',
      'unreadUsersCount',
      'unreadUsersDetails',
      'totalProjects',
      'likesOnMyProjects',
      'likesCount',
      'subscriptionType',
      'userSubscriptionMessage'
    ))->with('currentTagId', $tagId);
  }

  public function profile($id)
  {
    $user = User::withCount('projects')
      ->withCount('likes')
      ->withCount('comments')
      ->findOrFail($id);

    $categories = Category::all();

    $unreadUsers = Message::where('receiver_id', Auth::id())
      ->where('is_read', false)
      ->groupBy('sender_id')
      ->get(['sender_id']);

    $unreadUsersCount = $unreadUsers->count();

    $unreadUsersDetails = User::whereIn('id', $unreadUsers->pluck('sender_id'))->get();

    $subscriptionType = null;
    $userSubscriptionMessage = '';  
    if (Auth::check()) {
      $myuser = Auth::user();
      $likesOnMyProjects = Like::with(['user', 'project'])
        ->whereIn('project_id', $myuser->projects->pluck('id'))
        ->get();

      $likesCount = $likesOnMyProjects->count();
      $subscription = $user->subscription;
      $subscriptionType = $subscription?->plan?->name ?? null;
        
        if ($subscriptionType === 'Normal') {
            $userSubscriptionMessage = 'You need to upgrade your subscription to access chat. Please subscribe to Pro Designer.';
        } elseif ($subscriptionType === 'Basic') {
            $userSubscriptionMessage = 'You need to upgrade your subscription to post featured projects. Please subscribe to Pro Designer.';
        }
    } else {
      $likesOnMyProjects = null;
      $likesCount = 0;
    }

    foreach ($user->projects as $project) {
      $project->image = !empty($project->image) ? asset($project->image) : asset('assets/img/blog/blog-hero-2.webp');
    }

    return view('public.pages.profile', compact('user', 'categories', 'unreadUsersCount', 'unreadUsersDetails', 'likesOnMyProjects', 'likesCount' , 'subscriptionType', 'userSubscriptionMessage'));
  }


  public function category()
  {
    $categories = Category::all();
    $unreadUsers = Message::where('receiver_id', Auth::id())
      ->where('is_read', false)
      ->groupBy('sender_id')
      ->get(['sender_id']);

    $unreadUsersCount = $unreadUsers->count();

    $unreadUsersDetails = User::whereIn('id', $unreadUsers->pluck('sender_id'))->get();

    if (Auth::check()) {
      $user = Auth::user();
      $likesOnMyProjects = Like::with(['user', 'project'])
        ->whereIn('project_id', $user->projects->pluck('id'))
        ->get();

      $likesCount = $likesOnMyProjects->count();
    } else {
      $likesOnMyProjects = null;
      $likesCount = 0;
    }
    return view('public.category.category', compact('categories', 'unreadUsersCount', 'unreadUsersDetails', 'likesOnMyProjects', 'likesCount'));
  }

  public function about()
  {
    $categories = Category::all();
    $unreadUsers = Message::where('receiver_id', Auth::id())
      ->where('is_read', false)
      ->groupBy('sender_id')
      ->get(['sender_id']);

    $unreadUsersCount = $unreadUsers->count();

    $unreadUsersDetails = User::whereIn('id', $unreadUsers->pluck('sender_id'))->get();

    if (Auth::check()) {
      $user = Auth::user();
      $likesOnMyProjects = Like::with(['user', 'project'])
        ->whereIn('project_id', $user->projects->pluck('id'))
        ->get();

      $likesCount = $likesOnMyProjects->count();
    } else {
      $likesOnMyProjects = null;
      $likesCount = 0;
    }
    return view('public.pages.about', compact('categories', 'unreadUsersCount', 'unreadUsersDetails', 'likesOnMyProjects', 'likesCount'));
  }

  public function contact()
  {
    $categories = Category::all();
    $unreadUsers = Message::where('receiver_id', Auth::id())
      ->where('is_read', false)
      ->groupBy('sender_id')
      ->get(['sender_id']);

    $unreadUsersCount = $unreadUsers->count();

    $unreadUsersDetails = User::whereIn('id', $unreadUsers->pluck('sender_id'))->get();

    if (Auth::check()) {
      $user = Auth::user();
      $likesOnMyProjects = Like::with(['user', 'project'])
        ->whereIn('project_id', $user->projects->pluck('id'))
        ->get();

      $likesCount = $likesOnMyProjects->count();
    } else {
      $likesOnMyProjects = null;
      $likesCount = 0;
    }
    return view('public.pages.contact', compact('categories', 'unreadUsersCount', 'unreadUsersDetails', 'likesOnMyProjects', 'likesCount'));
  }

  public function storeContact(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'email' => 'required|email',
      'phone' => 'required',
      'subject' => 'required',
      'message' => 'required',
    ]);

    try {
      $body = "You have received a new message from the Contact Us page:\n\n";
      $body .= "Name: {$request->name}\n";
      $body .= "Phone Number: {$request->phone}\n";
      $body .= "Subject: {$request->subject}\n";
      $body .= "Message:\n{$request->message}\n\n";
      $body .= "This message was sent as user feedback through the Contact Us form on your website.";

      Mail::raw($body, function ($message) use ($request) {
        $message->to(env('MAIL_FROM_ADDRESS'))
          ->subject('New Contact Message')
          ->from($request->email, $request->name);
      });

      return redirect()->back()->with('success', 'Your message has been sent successfully!');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
    }
  }

  public function addProject()
  {
    $categories = Category::all();
    $tags = Tag::all();
    $unreadUsers = Message::where('receiver_id', Auth::id())
      ->where('is_read', false)
      ->groupBy('sender_id')
      ->get(['sender_id']);

    $unreadUsersCount = $unreadUsers->count();

    $unreadUsersDetails = User::whereIn('id', $unreadUsers->pluck('sender_id'))->get();

    if (Auth::check()) {
      $user = Auth::user();
      $likesOnMyProjects = Like::with(['user', 'project'])
        ->whereIn('project_id', $user->projects->pluck('id'))
        ->get();

      $likesCount = $likesOnMyProjects->count();
      $subscription = $user->subscription;
      $subscriptionType = $subscription?->plan?->name ?? null;
      // dd($subscriptionType);
    } else {
      $likesOnMyProjects = null;
      $likesCount = 0;
    }
    return view('public.category.addproject', compact('categories', 'unreadUsersCount', 'unreadUsersDetails', 'likesOnMyProjects', 'likesCount', 'tags' , 'subscriptionType'));
  }

  public function storeProject(Request $request)
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'nullable|string',
      'images' => 'nullable|array',
      'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
      'category_id' => 'required|exists:categories,id',
      'tags' => 'nullable|array',
      'tags.*' => 'exists:tags,id',
    ]);

    $imagePaths = [];

    if ($request->hasFile('images')) {
      foreach ($request->file('images') as $image) {
        $folder = 'projects';
        $imageName = time() . '_' . $image->getClientOriginalName();
        $imagePath = "images/$folder/$imageName";

        if (!file_exists(public_path($imagePath))) {
          $image->move(public_path("images/$folder"), $imageName);
        }

        $imagePaths[] = $imagePath;
      }
    }

    $project = Project::create([
      'title' => $request->title,
      'description' => $request->description,
      'user_id' => Auth::id(),
      'category_id' => $request->category_id,
      'featured_post' => $request->input('featured_post') == 1 ? true : false,
    ]);

    foreach ($imagePaths as $path) {
      ProjectImage::create([
        'project_id' => $project->id,
        'image' => $path,
      ]);
    }

    if ($request->filled('tags')) {
      foreach ($request->tags as $tagId) {
        DB::table('project_tags')->insert([
          'user_id' => Auth::id(),
          'project_id' => $project->id,
          'tag_id' => $tagId,
          'created_at' => now(),
          'updated_at' => now(),
        ]);
      }
    }

    return redirect()->route('category.posts', $project->category_id)->with('success', 'Project added successfully.');
  }



  public function indexChat($receiver_id)
  {
    $receiver = User::with('profile')->findOrFail($receiver_id);
    $categories = Category::all();
    $unreadUsers = Message::where('receiver_id', Auth::id())
      ->where('is_read', false)
      ->groupBy('sender_id')
      ->get(['sender_id']);

    $unreadUsersCount = $unreadUsers->count();

    $unreadUsersDetails = User::whereIn('id', $unreadUsers->pluck('sender_id'))->get();

    $messages = Message::where(function ($query) use ($receiver_id) {
      $query->where('sender_id', Auth::id())->where('receiver_id', $receiver_id);
    })
      ->orWhere(function ($query) use ($receiver_id) {
        $query->where('sender_id', $receiver_id)->where('receiver_id', Auth::id());
      })
      ->orderBy('created_at', 'asc')
      ->get();

    Message::where('sender_id', $receiver_id)
      ->where('receiver_id', Auth::id())
      ->where('is_read', false)
      ->update(['is_read' => true]);

    $chatUserIds = Message::where(function ($query) {
      $query->where('sender_id', Auth::id())
        ->orWhere('receiver_id', Auth::id());
    })
      ->pluck('sender_id')
      ->merge(
        Message::where(function ($query) {
          $query->where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id());
        })->pluck('receiver_id')
      )
      ->unique()
      ->reject(function ($id) {
        return $id == Auth::id();
      });

    $chatUsers = User::with('profile')->whereIn('id', $chatUserIds)->get();

    if (Auth::check()) {
      $user = Auth::user();
      $likesOnMyProjects = Like::with(['user', 'project'])
        ->whereIn('project_id', $user->projects->pluck('id'))
        ->get();

      $likesCount = $likesOnMyProjects->count();
    } else {
      $likesOnMyProjects = null;
      $likesCount = 0;
    }

    return view('public.pages.chat', compact('messages', 'receiver', 'categories', 'unreadUsersCount', 'unreadUsersDetails', 'chatUsers', 'likesOnMyProjects', 'likesCount'));
  }

  public function sendMessage(Request $request)
  {
    $request->validate([
      'receiver_id' => 'required|exists:users,id',
      'message' => 'required|string|max:1000',
    ]);

    Message::create([
      'sender_id' => Auth::id(),
      'receiver_id' => $request->receiver_id,
      'message' => $request->message,
    ]);

    return response()->json(['success' => true]);
  }

  public function fetchMessages($receiver_id)
  {
    $messages = Message::where(function ($query) use ($receiver_id) {
      $query->where('sender_id', Auth::id())->where('receiver_id', $receiver_id);
    })
      ->orWhere(function ($query) use ($receiver_id) {
        $query->where('sender_id', $receiver_id)->where('receiver_id', Auth::id());
      })
      ->orderBy('created_at', 'asc')
      ->get();

    return response()->json(['messages' => $messages]);
  }

  public function search(Request $request)
  {
    $searchTerm = $request->input('query');
    $categories = Category::all();
    $unreadUsers = Message::where('receiver_id', Auth::id())
      ->where('is_read', false)
      ->groupBy('sender_id')
      ->get(['sender_id']);

    $unreadUsersCount = $unreadUsers->count();

    $unreadUsersDetails = User::whereIn('id', $unreadUsers->pluck('sender_id'))->get();

    $projects = Project::where('title', 'like', '%' . $searchTerm . '%')
      ->orWhere('description', 'like', '%' . $searchTerm . '%')
      ->get();

    $categoriesSearch = Category::where('name', 'like', '%' . $searchTerm . '%')->get();

    $subscriptionType = null;
    $userSubscriptionMessage = ''; 
    if (Auth::check()) {
      $user = Auth::user();
      $likesOnMyProjects = Like::with(['user', 'project'])
        ->whereIn('project_id', $user->projects->pluck('id'))
        ->get();

      $likesCount = $likesOnMyProjects->count();

      $subscription = $user->subscription;
        $subscriptionType = $subscription?->plan?->name ?? null;
        
        if ($subscriptionType === 'Normal') {
            $userSubscriptionMessage = 'You need to upgrade your subscription to access chat. Please subscribe to Pro Designer.';
        } elseif ($subscriptionType === 'Basic') {
            $userSubscriptionMessage = 'You need to upgrade your subscription to post featured projects. Please subscribe to Pro Designer.';
        }
    } else {
      $likesOnMyProjects = null;
      $likesCount = 0;
    }

    return view('public.pages.search', compact('projects', 'categories', 'categoriesSearch', 'unreadUsersCount', 'unreadUsersDetails', 'likesOnMyProjects', 'likesCount' , 'subscriptionType', 'userSubscriptionMessage'));
  }

  public function editProject($id)
  {
    $project = Project::with('images')->findOrFail($id);
    // dd($project);
    $categories = Category::all();
    $unreadUsers = Message::where('receiver_id', Auth::id())
      ->where('is_read', false)
      ->groupBy('sender_id')
      ->get(['sender_id']);

    $unreadUsersCount = $unreadUsers->count();

    $unreadUsersDetails = User::whereIn('id', $unreadUsers->pluck('sender_id'))->get();

    if (Auth::check()) {
      $user = Auth::user();
      $likesOnMyProjects = Like::with(['user', 'project'])
        ->whereIn('project_id', $user->projects->pluck('id'))
        ->get();

      $likesCount = $likesOnMyProjects->count();
    } else {
      $likesOnMyProjects = null;
      $likesCount = 0;
    }
    return view('public.category.editproject', compact('project', 'categories', 'unreadUsersCount', 'unreadUsersDetails', 'likesOnMyProjects', 'likesCount'));
  }
  public function updateProject(Request $request, $id)
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'nullable|string',
      'category_id' => 'required|exists:categories,id',
      'images' => 'nullable|array',
      'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
    ]);

    $project = Project::findOrFail($id);

    $project->update([
      'title' => $request->title,
      'description' => $request->description,
      'category_id' => $request->category_id,
    ]);
    $project->images()->delete();
    if ($request->hasFile('images')) {
      foreach ($request->file('images') as $image) {
        $folder = 'projects';
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path("images/$folder"), $imageName);
        $imagePath = "images/$folder/$imageName";
        $project->images()->create([
          'project_id' => $project->id,
          'image' => $imagePath,
        ]);
      }
    }
    return redirect()->route('profile', $project->user_id)->with('success', 'Project updated successfully.');
  }

  public function destroyProject($id)
  {
    $project = Project::findOrFail($id);
    $project->delete();
    return redirect()->route('profile', $project->user_id)->with('success', 'Project deleted successfully.');
  }

  public function editUser(User $user)
  {
    $user->load('profile');
    $categories = Category::all();
    $unreadUsers = Message::where('receiver_id', Auth::id())
      ->where('is_read', false)
      ->groupBy('sender_id')
      ->get(['sender_id']);

    $unreadUsersCount = $unreadUsers->count();

    $unreadUsersDetails = User::whereIn('id', $unreadUsers->pluck('sender_id'))->get();

    if (Auth::check()) {
      $myuser = Auth::user();
      $likesOnMyProjects = Like::with(['user', 'project'])
        ->whereIn('project_id', $myuser->projects->pluck('id'))
        ->get();

      $likesCount = $likesOnMyProjects->count();
    } else {
      $likesOnMyProjects = null;
      $likesCount = 0;
    }
    return view('public.pages.editProfile', compact('user', 'categories', 'unreadUsersCount', 'unreadUsersDetails', 'likesOnMyProjects', 'likesCount'));
  }

  public function updateUser(Request $request, User $user)
  {
    $formType = $request->input('form_type');

    if ($formType === 'profile') {
      $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'bio' => 'nullable|string|max:1000',
        'location' => 'nullable|string|max:255',
        'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
      ]);

      if ($request->hasFile('profile_picture')) {
        $image = $request->file('profile_picture');
        $folder = 'profile_pictures';
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path("images/$folder"), $imageName);
        $imagePath = "images/$folder/$imageName";
      } else {
        $imagePath = null;
      }

      $user->update([
        'name' => $request->name,
        'email' => $request->email,
      ]);

      $user->profile()->updateOrCreate([], [
        'bio' => $request->bio,
        'location' => $request->location,
        'profile_picture' => $imagePath ?? $user->profile->profile_picture,
      ]);
    } elseif ($formType === 'social') {
      $request->validate([
        'facebook' => 'nullable|url',
        'twitter' => 'nullable|url',
        'linkedin' => 'nullable|url',
        'instagram' => 'nullable|url',
      ]);

      $user->profile()->updateOrCreate([], [
        'facebook' => $request->facebook,
        'twitter' => $request->twitter,
        'linkedin' => $request->linkedin,
        'instagram' => $request->instagram,
      ]);
    } else {
      if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'The current password is incorrect.'])->withInput();
      }

      $request->validate([
        'new_password' => 'required|string|min:8|confirmed',
      ]);

      $user->update([
        'password' => Hash::make($request->new_password),
      ]);
    }

    return redirect()->route('usersprofile.edit', $user->id)->with('success', 'Profile updated successfully!')->withErrors('error', 'Password not updated successfully!');
  }

  public function destroyUser(User $user)
  {
    if (Auth::id() !== $user->id) {
      abort(403, 'Unauthorized action.');
    }

    $user->delete();

    Auth::logout();

    return redirect('/')->with('status', 'Your account has been deleted.');
  }

  public function subecribtion()
  {
    $categories = Category::all();

    $projects = Project::with(['user.profile', 'category'])
      ->withCount('likes')
      ->withCount('comments')
      ->with('userLike')
      ->get();

    $unreadUsers = Message::where('receiver_id', Auth::id())
      ->where('is_read', false)
      ->groupBy('sender_id')
      ->get(['sender_id']);

    $unreadUsersCount = $unreadUsers->count();
    $unreadUsersDetails = User::whereIn('id', $unreadUsers->pluck('sender_id'))->get();

    if (Auth::check()) {
      $user = Auth::user();
      $likesOnMyProjects = Like::with(['user', 'project'])
        ->whereIn('project_id', $user->projects->pluck('id'))
        ->get();

      $likesCount = $likesOnMyProjects->count();
    } else {
      $likesOnMyProjects = null;
      $likesCount = 0;
    }

    return view('public.pages.subscription', compact('categories', 'projects', 'unreadUsersCount', 'unreadUsersDetails', 'likesOnMyProjects', 'likesCount'));
  }

  public function payment()
  {
    $categories = Category::all();

    $projects = Project::with(['user.profile', 'category'])
      ->withCount('likes')
      ->withCount('comments')
      ->with('userLike')
      ->get();

    $unreadUsers = Message::where('receiver_id', Auth::id())
      ->where('is_read', false)
      ->groupBy('sender_id')
      ->get(['sender_id']);

    $unreadUsersCount = $unreadUsers->count();
    $unreadUsersDetails = User::whereIn('id', $unreadUsers->pluck('sender_id'))->get();

    if (Auth::check()) {
      $user = Auth::user();
      $likesOnMyProjects = Like::with(['user', 'project'])
        ->whereIn('project_id', $user->projects->pluck('id'))
        ->get();

      $likesCount = $likesOnMyProjects->count();
    } else {
      $likesOnMyProjects = null;
      $likesCount = 0;
    }

    return view('public.pages.payment', compact('categories', 'projects', 'unreadUsersCount', 'unreadUsersDetails', 'likesOnMyProjects', 'likesCount'));
  }
}
