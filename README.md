# xmlview
Component base view based on XML files

Not much documentation yet, this is coming soon.
For now a simple example:

<page type="@hrPage">
    <datalayer type="App\Vc\Route\EditLayer" />
    <openLayer trace="${routeTrace}" />
    <form title="__Edit route" url="${url}">
        <formText name='title' label="__Title" />       
        <formText name="location" label="__Location" />
        <formCheckBox name="publish" label="__Publish?" />
        <formTextArea name="comment" label="__Comment" />
    </form>
</page>