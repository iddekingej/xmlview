# xmlview
Component base view based on XML files

Not much documentation yet, this is coming soon.
For now a simple example:
<code>
&lt;page type="@hrPage"&gt;
    &lt;datalayer type="App\Vc\Route\EditLayer" /&gt;
    &lt;openLayer trace="${routeTrace}" /&gt;
    &lt;form title="__Edit route" url="${url}"&gt;
        &lt;formText name='title' label="__Title" /&gt;       
        &lt;formText name="location" label="__Location" /&gt;
        &lt;formCheckBox name="publish" label="__Publish?" /&gt;
        &lt;formTextArea name="comment" label="__Comment" /&gt;
    &lt;/form&gt;
&lt;/page&gt;
</code>