using System;
using System.Collections.Generic;

namespace PnP_Universal.Models
{
    public partial class Attributes
    {
        public int Id { get; set; }
        public string Name { get; set; }
        public int Template { get; set; }
        public int MinValue { get; set; }
        public int MaxValue { get; set; }

        public Templates IdNavigation { get; set; }
        public AttributeOwnership AttributeOwnership { get; set; }
    }
}
