<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket_detail;
use App\Models\Ticket_type;
use Illuminate\Support\Facades\Auth;
use App\Traits\HttpResponses;
use ImageIntervention;

class TicketController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TicketResource::collection(Ticket::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        $request->validated($request->all());

        if ($request->hasFile('attachments')) {
            $attachments = [];
            foreach($request->file('attachments') as $attachment) {
                $extension = $attachment->getClientOriginalExtension();
                $attachment_name = time() . '.' . $extension;
                $attachment_path = '/images/attachments/' . $attachment_name;
                ImageIntervention::make($attachment)->save(public_path($attachment_path));
                array_push($attachments, $attachment_path);
            }
        }

        $ticketDetails = [
            'module_type' => $request->module_type, 
            'details_desc' => $request->details_desc,
            'attachments' => ($attachments) ?? null
        ];
    
        // $jsonTicketDetails = json_encode($ticketDetails);

        $ticket_type = Ticket_type::find($request->type_id);
        
        $ticket = Ticket::create([
            'department_id' => $ticket_type->department_id,
            'type_id' => $request->type_id,
            'ticket_details' => $ticketDetails,
            'priority' => ($request->priority) ?? "medium",
            'status' => ($request->status)?? "open",
            'acknowledged_by' => $request->acknowledge_by,
            'acknowledged_at' => $request->acknowledge_at,
            'created_by' => auth('api')->user()->id,
            'updated_by' => $request->updated_by,
            'resolved_by' => $request->resolved_by,
            'resolved_at' => $request->resolved_at,
            'assigned_to' => $request->assigned_to,
            'assigned_by' => $request->assigned_by,
            'deleted_by' => $request->deleted_by,
        ]);
       
        // Ticket_detail::create([
        //     'ticket_id' => $ticket->id,
        //     'ticket_type_id' => $ticket_type->id,
        //     'attachments' => $attachments ?? null,
        // ]);

        return new TicketResource($ticket);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return new TicketResource($ticket);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $ticket->update($request->all());

        return $this->success(new TicketResource($ticket), "Ticket has been updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return response(null, 204);
    }
}
