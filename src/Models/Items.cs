using System;
using System.Collections.Generic;

namespace PnP_Universal.Models
{
    public partial class Items
    {
        public int Id { get; set; }
        public string Name { get; set; }
        public int? Adventure { get; set; }
        public string Type { get; set; }

        public Adventures IdNavigation { get; set; }
        public ItemOwnership ItemOwnership { get; set; }
    }
}
