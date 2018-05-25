using System;
using System.Collections.Generic;

namespace PnP_Universal.Models
{
    public partial class Heroes
    {
        public int Id { get; set; }
        public string Name { get; set; }
        public int Owner { get; set; }
        public int Template { get; set; }
        public int? Adventure { get; set; }
        public string Stats { get; set; }

        public Templates Id1 { get; set; }
        public Users Id2 { get; set; }
        public Adventures IdNavigation { get; set; }
        public AttributeOwnership AttributeOwnership { get; set; }
        public ItemOwnership ItemOwnership { get; set; }
    }
}
