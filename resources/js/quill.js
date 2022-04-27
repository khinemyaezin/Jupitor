window.Quill = require('Quill');
// const Size = Quill.import('attributors/style/size');
// Size.whitelist = ['14px', '19.2px', '32px'];

const Block = Quill.import("blots/block");
class DivBlock extends Block {}

DivBlock.tagName = "DIV";

// true means we overwrite
Quill.register("blots/block", DivBlock, true);
//Quill.register(Size, true);
