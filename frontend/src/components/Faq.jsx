import React, { useState } from "react";

const Faq = (props) => {
  const [item, setItem] = useState(props.data);

  const handleToggleActive = () => {
    setItem({ ...item, active: !item.active });
  };

  return (
    <div
      className={`bg-[#F3F2F9] p-5 mb-5 border-[#c9c6c655] rounded-md w-[700px] duration-500 group ${
        item.active ? "is-active bg-white" : ""
      }`}
    >
      <div className="flex items-center">
        <div className="w-full duration-500 group-[.is-active]:font-bold">
          {item.question}
        </div>
        <div
          className="text-xl rotate-90 duration-500 cursor-pointer group-[.is-active]:rotate-[270deg]"
          onClick={handleToggleActive}
        >
          {item.active ? "-" : "+"}
        </div>
      </div>
      <div className={`overflow-hidden duration-500 ${item.active ? "max-h-[100px]" : "max-h-0"}`}>
        {item.answer}
      </div>
    </div>
  );
};

export default Faq;
