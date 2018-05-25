using System;
using System.Collections.Generic;

namespace PnP_Universal.Models
{
    public partial class AttributeOwnership
    {
        public int Id { get; set; }
        public int Hero { get; set; }
        public int? Attribute { get; set; }
        public int Val { get; set; }

        public Heroes Id1 { get; set; }
        public Attributes IdNavigation { get; set; }
    }
}
