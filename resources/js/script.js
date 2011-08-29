/**
 * Add a new input[type="text"] to the proposal list
 */
function addNewProposal()
{
    var d = document;
    var container = d.createDocumentFragment();
    var p = d.createElement("p");
    var input = d.createElement("input");

    input.type = "text";
    input.name = "newProposals[]";

    p.appendChild(input);
    container.appendChild(p);

    d.getElementById("proposals").appendChild(container);
    input.focus();
    
    return;
}

/**
 * Delete a proposal
 * @param elem Element The DOM Element to remove
 * @param proposalId int The id of the proposal we want to remove
 */
function deleteProposal(elem, proposalId)
{
    var d = document;
    var input = d.createElement("input");
    var container = d.getElementById("proposals");

    input.type = "hidden";
    input.name = "obsoleteProposals[]";
    input.value = proposalId;

    container.appendChild(input);
    container.removeChild(elem);

    return;
}