<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    public function index()
    {
        $list = Contact::select('id', 'name', 'phone', 'email', 'status', 'title', 'content', 'created_by')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('backend.contact.index', compact('list'));
    }

    public function create()
    {
        return view('backend.contact.create');
    }

    public function store(StoreContactRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->title = $request->title;
        $contact->content = $request->content;
        $contact->status = $request->status;
        $contact->created_by = Auth::id() ?? 1;
        $contact->slug = Str::slug($request->name);
        $contact->save();

        return redirect()->route('contact.index')->with('success', 'Thêm liên hệ thành công');
    }

    public function edit(string $id)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            return redirect()->route('contact.index')->with('error', 'Liên hệ không tồn tại');
        }
        return view('backend.contact.edit', compact('contact'));
    }

    public function update(Request $request, string $id)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            return redirect()->route('contact.index')->with('error', 'Không tìm thấy liên hệ');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'status' => 'required|in:0,1',
            'created_by' => 'nullable|integer',
        ]);

        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->title = $request->title;
        $contact->content = $request->content;
        $contact->status = $request->status;
        $contact->created_by = $request->created_by ?? Auth::id();
        $contact->updated_by = Auth::id();
        $contact->updated_at = now();

        $contact->save();

        return redirect()->route('contact.index')->with('success', 'Cập nhật liên hệ thành công');
    }

    public function delete($id)
    {
        $contact = Contact::find($id);
        if ($contact) {
            $contact->delete();
        }
        return redirect()->route('contact.index')->with('success', 'Liên hệ đã được chuyển vào thùng rác');
    }

    public function trash()
    {
        $list = Contact::onlyTrashed()
            ->select('id', 'name', 'phone', 'email', 'status', 'title', 'content', 'created_by', 'deleted_at')
            ->orderBy('deleted_at', 'desc')
            ->paginate(5);

        return view('backend.contact.trash', compact('list'));
    }

    public function restore($id)
    {
        $contact = Contact::withTrashed()->find($id);
        if ($contact) {
            $contact->restore();
            return redirect()->route('contact.index')->with('success', 'Liên hệ đã được khôi phục');
        }

        return redirect()->route('contact.index')->with('error', 'Không tìm thấy liên hệ');
    }

    public function destroy(string $id)
    {
        $contact = Contact::onlyTrashed()->find($id);
        if ($contact) {
            $contact->forceDelete();
            return redirect()->route('contact.trash')->with('success', 'Đã xóa vĩnh viễn liên hệ');
        }

        return redirect()->route('contact.trash')->with('error', 'Không tìm thấy liên hệ');
    }

    public function status($id)
    {
        $contact = Contact::find($id);
        if ($contact) {
            $contact->status = $contact->status == 1 ? 0 : 1;
            $contact->updated_by = Auth::id();
            $contact->updated_at = now();
            $contact->save();
        }

        return redirect()->route('contact.index');
    }
}
